<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Favorite\Models\Favorite;

/**
 * @property Favorite $model
 * @method Favorite findOneOrFail($id)
 * @method Favorite findOneByOrFail(array $data)
 */
class FavoriteRepository extends BaseRepository
{
    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }

    public function getFavoriteList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }
    public function paginated(
        array $conditions = [],
        int $page = 1,
        int $perPage = 15,
        string $orderBy = 'created_at',
        string $sortBy = 'desc'
    ) {
        if (method_exists($this->model, 'scopeFilter')) {
            $query = $this->model->filter(request()->all())->where($conditions);
        } else {
            $query = $this->model->where($conditions);
        }
        $query->whereHas('shop.barber', function ($q) {
            $q->where('is_active', 1);
        });


        $count = $query->count();
        $paginatedData = $query->forPage($page, $perPage)->orderBy($orderBy, $sortBy)->get();
        $paginationArray = $this->getPaginationInformation($page, $perPage, $count);

        return [
            'pagination' => $paginationArray['pagination'],
            'data' => $paginatedData,
        ];
    }
    public function getFavorite(UuidInterface $id): Favorite
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createFavorite(array $data): Favorite
    {
        return $this->create($data);
    }

    public function updateFavorite(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }
public function createOrDeleteFavorite(array $data): Favorite
{
    $existing = $this->model
        ->where('shop_id', $data['shop_id'])
        ->where('client_id', $data['client_id'])
        ->first();

    if ($existing) {
        $existing->delete();

        $existing->was_deleted = true;
        return $existing;
    }

    return $this->create($data);
}
    public function deleteFavorite(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

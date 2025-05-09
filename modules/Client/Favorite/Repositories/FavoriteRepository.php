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

<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\FavoriteClient\Models\FavoriteClient;
use Modules\Client\Favorite\Models\Favorite;

/**
 * @property FavoriteClient $model
 * @method FavoriteClient findOneOrFail($id)
 * @method FavoriteClient findOneByOrFail(array $data)
 */
class FavoriteClientRepository extends BaseRepository
{
    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return Favorite::query()
            ->with(['shop', 'client'])
            ->paginate($perPage, ['*'], 'page', $page);
    }
    public function getFavoriteClientList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getFavoriteClient(UuidInterface $id): Favorite
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createFavoriteClient(array $data): Favorite
    {
        return $this->create($data);
    }

    public function updateFavoriteClient(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteFavoriteClient(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

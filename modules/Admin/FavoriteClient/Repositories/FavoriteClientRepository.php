<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\FavoriteClient\Models\FavoriteClient;

/**
 * @property FavoriteClient $model
 * @method FavoriteClient findOneOrFail($id)
 * @method FavoriteClient findOneByOrFail(array $data)
 */
class FavoriteClientRepository extends BaseRepository
{
    public function __construct(FavoriteClient $model)
    {
        parent::__construct($model);
    }

    public function getFavoriteClientList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getFavoriteClient(UuidInterface $id): FavoriteClient
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createFavoriteClient(array $data): FavoriteClient
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

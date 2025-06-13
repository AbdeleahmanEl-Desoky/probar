<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\ShopBarber\Models\ShopBarber;

/**
 * @property ShopBarber $model
 * @method ShopBarber findOneOrFail($id)
 * @method ShopBarber findOneByOrFail(array $data)
 */
class ShopBarberRepository extends BaseRepository
{
    public function __construct(ShopBarber $model)
    {
        parent::__construct($model);
    }

    public function getShopBarberList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopBarber(UuidInterface $id): ShopBarber
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopBarber(array $data): ShopBarber
    {
        return $this->create($data);
    }

    public function updateShopBarber(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopBarber(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

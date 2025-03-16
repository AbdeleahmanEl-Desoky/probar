<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\Shop\Models\Shop;

/**
 * @property Shop $model
 * @method Shop findOneOrFail($id)
 * @method Shop findOneByOrFail(array $data)
 */
class ShopRepository extends BaseRepository
{
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }

    public function getShopList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShop(UuidInterface $id): Shop
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShop(array $data): Shop
    {
        return $this->create($data);
    }

    public function updateShop(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShop(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

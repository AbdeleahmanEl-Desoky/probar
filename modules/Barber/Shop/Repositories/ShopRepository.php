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

    public function getMyShop(UuidInterface $barber_id): ?Shop
    {
        return $this->model->where([
            'barber_id' => $barber_id->toString(),
        ])->first();
    }

    public function createShop(array $data): Shop
    {
        return $this->create($data);
    }

    public function updateShopStatus($id)//: bool
    {
        $shop = $this->model->whereId($id)->first();

        $shop->update([
            'is_open' =>$shop->is_open ^1,
        ]);

        return $shop->refresh();
    }
    public function updateShopHold(UuidInterface $id): Shop
    {
        $shop = $this->model->whereId($id)->first();

        $shop->update([
            'hold' => $shop->hold  +10,
        ]);

        return $shop->refresh();
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

<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\ShopHour\Models\ShopHourDetail;

/**
 * @property ShopHourDetail $model
 * @method ShopHourDetail findOneOrFail($id)
 * @method ShopHourDetail findOneByOrFail(array $data)
 */
class ShopHourDetailRepository extends BaseRepository
{
    public function __construct(ShopHourDetail $model)
    {
        parent::__construct($model);
    }

    public function getShopHourDetailList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopHourDetail(UuidInterface $id): ShopHourDetail
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopHourDetail(array $data): ShopHourDetail
    {
        return $this->create($data);
    }

    public function updateShopHourDetail(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopHourDetail(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

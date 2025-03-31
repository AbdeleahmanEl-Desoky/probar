<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Barber\Shop\Models\Shop;
use Ramsey\Uuid\UuidInterface;

/**
 * @property Shop $model
 * @method Shops findOneOrFail($id)
 * @method Shops findOneByOrFail(array $data)
 */
class ShopsRepository extends BaseRepository
{
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }

    public function getShopsList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShops(UuidInterface $id): Shop
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

}

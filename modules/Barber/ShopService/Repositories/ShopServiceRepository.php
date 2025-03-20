<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\ShopService\Models\ShopService;

/**
 * @property ShopService $model
 * @method ShopService findOneOrFail($id)
 * @method ShopService findOneByOrFail(array $data)
 */
class ShopServiceRepository extends BaseRepository
{
    public function __construct(ShopService $model)
    {
        parent::__construct($model);
    }

    public function getShopServiceList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopService(UuidInterface $id): ShopService
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopService(array $data): ShopService
    {
        return $this->create($data);
    }

    public function updateShopService(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopService(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

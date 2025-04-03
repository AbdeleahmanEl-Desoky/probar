<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Barber\ShopService\Models\ShopService;
use Ramsey\Uuid\UuidInterface;

/**
 * @property ShopService $model
 * @method ShopServices findOneOrFail($id)
 * @method ShopServices findOneByOrFail(array $data)
 */
class ShopServicesRepository extends BaseRepository
{
    public function __construct(ShopService $model)
    {
        parent::__construct($model);
    }

    public function getShopServicesList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopServices(UuidInterface $id): ShopService
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopServices(array $data): ShopService
    {
        return $this->create($data);
    }

    public function updateShopServices(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopServices(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

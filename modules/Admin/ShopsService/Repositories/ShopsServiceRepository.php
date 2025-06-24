<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\ShopService\Models\ShopService;

/**
 * @property ShopService $model
 * @method ShopsService findOneOrFail($id)
 * @method ShopsService findOneByOrFail(array $data)
 */
class ShopsServiceRepository extends BaseRepository
{
    public function __construct(ShopService $model)
    {
        parent::__construct($model);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return ShopService::query()
            ->with('media', 'shop')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function getShopsServiceList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopsService(UuidInterface $id): ShopService
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopsService(array $data): ShopService
    {
        return $this->create($data);
    }

    public function updateShopsService(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopsService(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

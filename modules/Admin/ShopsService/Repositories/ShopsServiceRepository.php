<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\ShopsService\Models\ShopsService;

/**
 * @property ShopsService $model
 * @method ShopsService findOneOrFail($id)
 * @method ShopsService findOneByOrFail(array $data)
 */
class ShopsServiceRepository extends BaseRepository
{
    public function __construct(ShopsService $model)
    {
        parent::__construct($model);
    }

    public function getShopsServiceList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopsService(UuidInterface $id): ShopsService
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopsService(array $data): ShopsService
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

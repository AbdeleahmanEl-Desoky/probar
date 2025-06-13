<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\RateAll\Models\RateAll;

/**
 * @property RateAll $model
 * @method RateAll findOneOrFail($id)
 * @method RateAll findOneByOrFail(array $data)
 */
class RateAllRepository extends BaseRepository
{
    public function __construct(RateAll $model)
    {
        parent::__construct($model);
    }

    public function getRateAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getRateAll(UuidInterface $id): RateAll
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createRateAll(array $data): RateAll
    {
        return $this->create($data);
    }

    public function updateRateAll(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteRateAll(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

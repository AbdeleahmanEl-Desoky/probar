<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\RateAll\Models\RateAll;
use Modules\Client\Rate\Models\Rate;

/**
 * @property Rate $model
 * @method RateAll findOneOrFail($id)
 * @method RateAll findOneByOrFail(array $data)
 */
class RateAllRepository extends BaseRepository
{
    public function __construct(Rate $model)
    {
        parent::__construct($model);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return Rate::query()
            ->with(['shop', 'client', 'schedule'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    }
    public function getRateAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getRateAll(UuidInterface $id): Rate
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createRateAll(array $data): Rate
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

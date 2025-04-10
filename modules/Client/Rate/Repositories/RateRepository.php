<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Rate\Models\Rate;

/**
 * @property Rate $model
 * @method Rate findOneOrFail($id)
 * @method Rate findOneByOrFail(array $data)
 */
class RateRepository extends BaseRepository
{
    public function __construct(Rate $model)
    {
        parent::__construct($model);
    }

    public function getRateList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getRate(UuidInterface $id): Rate
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createRate(array $data): Rate
    {
        return $this->create($data);
    }

    public function updateRate(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteRate(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\ReportAll\Models\ReportAll;

/**
 * @property ReportAll $model
 * @method ReportAll findOneOrFail($id)
 * @method ReportAll findOneByOrFail(array $data)
 */
class ReportAllRepository extends BaseRepository
{
    public function __construct(ReportAll $model)
    {
        parent::__construct($model);
    }

    public function getReportAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getReportAll(UuidInterface $id): ReportAll
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createReportAll(array $data): ReportAll
    {
        return $this->create($data);
    }

    public function updateReportAll(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteReportAll(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

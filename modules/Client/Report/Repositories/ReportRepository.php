<?php

declare(strict_types=1);

namespace Modules\Client\Report\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Report\Models\Report;

/**
 * @property Report $model
 * @method Report findOneOrFail($id)
 * @method Report findOneByOrFail(array $data)
 */
class ReportRepository extends BaseRepository
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    public function getReportList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getReport(UuidInterface $id): Report
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createReport(array $data): Report
    {
        return $this->create($data);
    }

    public function updateReport(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteReport(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

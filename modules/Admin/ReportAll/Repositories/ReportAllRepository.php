<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Report\Models\Report;

/**
 * @property Report $model
 * @method Report findOneOrFail($id)
 * @method Report findOneByOrFail(array $data)
 */
class ReportAllRepository extends BaseRepository
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    public function getReportAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return Report::query()
            ->with(['shop', 'client', 'schedule'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    }
    public function getReportAll(UuidInterface $id): Report
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createReportAll(array $data): Report
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

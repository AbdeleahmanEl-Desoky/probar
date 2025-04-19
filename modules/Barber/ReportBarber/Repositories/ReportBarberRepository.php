<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Barber\CoreBarber\Models\Barber;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\ReportBarber\Models\ReportBarber;
use Modules\Client\Report\Models\Report;

/**
 * @property Report $model
 * @method ReportBarber findOneOrFail($id)
 * @method ReportBarber findOneByOrFail(array $data)
 */
class ReportBarberRepository extends BaseRepository
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    public function getReportBarberList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getReportBarber(UuidInterface $id): Report
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createReportBarber(array $data): Report
    {
        return $this->create($data);
    }

    public function updateReportBarber(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteReportBarber(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

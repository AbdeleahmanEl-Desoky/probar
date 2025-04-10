<?php

declare(strict_types=1);

namespace Modules\Client\Report\Services;

use Illuminate\Support\Collection;
use Modules\Client\Report\DTO\CreateReportDTO;
use Modules\Client\Report\Models\Report;
use Modules\Client\Report\Repositories\ReportRepository;
use Ramsey\Uuid\UuidInterface;

class ReportCRUDService
{
    public function __construct(
        private ReportRepository $repository,
    ) {
    }

    public function create(CreateReportDTO $createReportDTO): Report
    {
         return $this->repository->createReport($createReportDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Report
    {
        return $this->repository->getReport(
            id: $id,
        );
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ReportAll\DTO\CreateReportAllDTO;
use Modules\Client\Report\Models\Report;
use Modules\Admin\ReportAll\Repositories\ReportAllRepository;
use Ramsey\Uuid\UuidInterface;

class ReportAllCRUDService
{
    public function __construct(
        private ReportAllRepository $repository,
    ) {
    }

    public function create(CreateReportAllDTO $createReportAllDTO): Report
    {
         return $this->repository->createReportAll($createReportAllDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10)
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Report
    {
        return $this->repository->getReportAll(
            id: $id,
        );
    }
}

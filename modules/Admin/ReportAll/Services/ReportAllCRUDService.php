<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ReportAll\DTO\CreateReportAllDTO;
use Modules\Admin\ReportAll\Models\ReportAll;
use Modules\Admin\ReportAll\Repositories\ReportAllRepository;
use Ramsey\Uuid\UuidInterface;

class ReportAllCRUDService
{
    public function __construct(
        private ReportAllRepository $repository,
    ) {
    }

    public function create(CreateReportAllDTO $createReportAllDTO): ReportAll
    {
         return $this->repository->createReportAll($createReportAllDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): ReportAll
    {
        return $this->repository->getReportAll(
            id: $id,
        );
    }
}

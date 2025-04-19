<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Services;

use Illuminate\Support\Collection;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Barber\ReportBarber\DTO\CreateReportBarberDTO;
use Modules\Barber\ReportBarber\Models\ReportBarber;
use Modules\Barber\ReportBarber\Repositories\ReportBarberRepository;
use Modules\Client\Report\Models\Report;
use Ramsey\Uuid\UuidInterface;

class ReportBarberCRUDService
{
    public function __construct(
        private ReportBarberRepository $repository,
    ) {
    }

    public function create(CreateReportBarberDTO $createReportBarberDTO): Report
    {
        return $this->repository->createReportBarber($createReportBarberDTO->toArray());
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
        return $this->repository->getReportBarber(
            id: $id,
        );
    }
}

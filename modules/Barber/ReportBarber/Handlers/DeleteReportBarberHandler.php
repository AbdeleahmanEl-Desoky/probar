<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Handlers;

use Modules\Barber\ReportBarber\Repositories\ReportBarberRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteReportBarberHandler
{
    public function __construct(
        private ReportBarberRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteReportBarber($id);
    }
}

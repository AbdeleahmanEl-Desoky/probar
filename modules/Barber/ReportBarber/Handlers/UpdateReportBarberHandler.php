<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Handlers;

use Modules\Barber\ReportBarber\Commands\UpdateReportBarberCommand;
use Modules\Barber\ReportBarber\Repositories\ReportBarberRepository;

class UpdateReportBarberHandler
{
    public function __construct(
        private ReportBarberRepository $repository,
    ) {
    }

    public function handle(UpdateReportBarberCommand $updateReportBarberCommand)
    {
        $this->repository->updateReportBarber($updateReportBarberCommand->getId(), $updateReportBarberCommand->toArray());
    }
}

<?php

declare(strict_types=1);

namespace Modules\Client\Report\Handlers;

use Modules\Client\Report\Commands\UpdateReportCommand;
use Modules\Client\Report\Repositories\ReportRepository;

class UpdateReportHandler
{
    public function __construct(
        private ReportRepository $repository,
    ) {
    }

    public function handle(UpdateReportCommand $updateReportCommand)
    {
        $this->repository->updateReport($updateReportCommand->getId(), $updateReportCommand->toArray());
    }
}

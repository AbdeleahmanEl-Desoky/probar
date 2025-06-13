<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Handlers;

use Modules\Admin\ReportAll\Commands\UpdateReportAllCommand;
use Modules\Admin\ReportAll\Repositories\ReportAllRepository;

class UpdateReportAllHandler
{
    public function __construct(
        private ReportAllRepository $repository,
    ) {
    }

    public function handle(UpdateReportAllCommand $updateReportAllCommand)
    {
        $this->repository->updateReportAll($updateReportAllCommand->getId(), $updateReportAllCommand->toArray());
    }
}

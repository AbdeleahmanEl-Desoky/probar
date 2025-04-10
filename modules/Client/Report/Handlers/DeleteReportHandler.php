<?php

declare(strict_types=1);

namespace Modules\Client\Report\Handlers;

use Modules\Client\Report\Repositories\ReportRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteReportHandler
{
    public function __construct(
        private ReportRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteReport($id);
    }
}

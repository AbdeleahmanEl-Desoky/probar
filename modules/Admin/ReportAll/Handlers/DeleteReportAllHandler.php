<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Handlers;

use Modules\Admin\ReportAll\Repositories\ReportAllRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteReportAllHandler
{
    public function __construct(
        private ReportAllRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteReportAll($id);
    }
}

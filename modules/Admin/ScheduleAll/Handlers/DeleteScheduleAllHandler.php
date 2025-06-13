<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Handlers;

use Modules\Admin\ScheduleAll\Repositories\ScheduleAllRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteScheduleAllHandler
{
    public function __construct(
        private ScheduleAllRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteScheduleAll($id);
    }
}

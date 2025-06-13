<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Handlers;

use Modules\Admin\ScheduleAll\Commands\UpdateScheduleAllCommand;
use Modules\Admin\ScheduleAll\Repositories\ScheduleAllRepository;

class UpdateScheduleAllHandler
{
    public function __construct(
        private ScheduleAllRepository $repository,
    ) {
    }

    public function handle(UpdateScheduleAllCommand $updateScheduleAllCommand)
    {
        $this->repository->updateScheduleAll($updateScheduleAllCommand->getId(), $updateScheduleAllCommand->toArray());
    }
}

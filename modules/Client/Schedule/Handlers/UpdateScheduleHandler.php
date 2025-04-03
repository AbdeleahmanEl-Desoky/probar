<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Handlers;

use Modules\Client\Schedule\Commands\UpdateScheduleCommand;
use Modules\Client\Schedule\Repositories\ScheduleRepository;

class UpdateScheduleHandler
{
    public function __construct(
        private ScheduleRepository $repository,
    ) {
    }

    public function handle(UpdateScheduleCommand $updateScheduleCommand)
    {
        $this->repository->updateSchedule($updateScheduleCommand->getId(), $updateScheduleCommand->toArray());
    }
}

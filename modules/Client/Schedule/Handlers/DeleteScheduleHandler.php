<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Handlers;

use Modules\Client\Schedule\Repositories\ScheduleRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteScheduleHandler
{
    public function __construct(
        private ScheduleRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteSchedule($id);
    }
}

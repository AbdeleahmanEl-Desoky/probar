<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Handlers;

use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopStatusCommand;
use Modules\Barber\ScheduleShop\Repositories\ScheduleShopRepository;

class UpdateScheduleShopStatusHandler
{
    public function __construct(
        private ScheduleShopRepository $repository,
    ) {
    }

    public function handle(UpdateScheduleShopStatusCommand $updateScheduleShopStatusCommand)
    {
        $this->repository->updateScheduleShop($updateScheduleShopStatusCommand->getId(), $updateScheduleShopStatusCommand->toArray());
    }
}

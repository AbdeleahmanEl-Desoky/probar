<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Handlers;

use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopCommand;
use Modules\Barber\ScheduleShop\Repositories\ScheduleShopRepository;

class UpdateScheduleShopHandler
{
    public function __construct(
        private ScheduleShopRepository $repository,
    ) {
    }

    public function handle(UpdateScheduleShopCommand $updateScheduleShopCommand)
    {
        $this->repository->updateScheduleShop($updateScheduleShopCommand->getId(), $updateScheduleShopCommand->toArray());
    }
}

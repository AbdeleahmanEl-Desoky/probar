<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Handlers;

use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopPaymentCommand;
use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopStatusCommand;
use Modules\Barber\ScheduleShop\Repositories\ScheduleShopRepository;

class UpdateScheduleShopPaymentHandler
{
    public function __construct(
        private ScheduleShopRepository $repository,
    ) {
    }

    public function handle(UpdateScheduleShopPaymentCommand $updateScheduleShopPaymentCommand)
    {
        $this->repository->updateScheduleShop($updateScheduleShopPaymentCommand->getId(), $updateScheduleShopPaymentCommand->toArray());
    }
}

<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Handlers;

use Modules\Barber\ShopHour\Commands\UpdateShopHourCommand;
use Modules\Barber\ShopHour\Repositories\ShopHourRepository;

class UpdateShopHourHandler
{
    public function __construct(
        private ShopHourRepository $repository,
    ) {
    }

    public function handle(UpdateShopHourCommand $updateShopHourCommand)
    {
        $this->repository->updateShopHour($updateShopHourCommand->getId(), $updateShopHourCommand->toArray());
    }
}

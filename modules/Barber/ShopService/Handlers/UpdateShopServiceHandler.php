<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Handlers;

use Modules\Barber\ShopService\Commands\UpdateShopServiceCommand;
use Modules\Barber\ShopService\Repositories\ShopServiceRepository;

class UpdateShopServiceHandler
{
    public function __construct(
        private ShopServiceRepository $repository,
    ) {
    }

    public function handle(UpdateShopServiceCommand $updateShopServiceCommand)
    {
        $this->repository->updateShopService($updateShopServiceCommand->getId(), $updateShopServiceCommand->toArray());
    }
}

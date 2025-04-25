<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Handlers;

use Modules\Barber\Shop\Commands\UpdateShopCommand;
use Modules\Barber\Shop\Repositories\ShopRepository;

class UpdateShopHandler
{
    public function __construct(
        private ShopRepository $repository,
    ) {
    }

    public function handle(UpdateShopCommand $updateShopCommand)
    {
        $this->repository->updateShop($updateShopCommand->id, $updateShopCommand->toArray());
    }
}

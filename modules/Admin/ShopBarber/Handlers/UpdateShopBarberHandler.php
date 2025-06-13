<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Handlers;

use Modules\Admin\ShopBarber\Commands\UpdateShopBarberCommand;
use Modules\Admin\ShopBarber\Repositories\ShopBarberRepository;

class UpdateShopBarberHandler
{
    public function __construct(
        private ShopBarberRepository $repository,
    ) {
    }

    public function handle(UpdateShopBarberCommand $updateShopBarberCommand)
    {
        $this->repository->updateShopBarber($updateShopBarberCommand->getId(), $updateShopBarberCommand->toArray());
    }
}

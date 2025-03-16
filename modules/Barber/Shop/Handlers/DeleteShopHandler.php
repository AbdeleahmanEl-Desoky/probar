<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Handlers;

use Modules\Barber\Shop\Repositories\ShopRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteShopHandler
{
    public function __construct(
        private ShopRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteShop($id);
    }
}

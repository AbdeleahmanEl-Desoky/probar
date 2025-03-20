<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Handlers;

use Modules\Barber\ShopService\Repositories\ShopServiceRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteShopServiceHandler
{
    public function __construct(
        private ShopServiceRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteShopService($id);
    }
}

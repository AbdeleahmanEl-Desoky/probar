<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Handlers;

use Modules\Admin\ShopBarber\Repositories\ShopBarberRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteShopBarberHandler
{
    public function __construct(
        private ShopBarberRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteShopBarber($id);
    }
}

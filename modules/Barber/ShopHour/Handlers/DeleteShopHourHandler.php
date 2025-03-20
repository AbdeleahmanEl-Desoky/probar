<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Handlers;

use Modules\Barber\ShopHour\Repositories\ShopHourRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteShopHourHandler
{
    public function __construct(
        private ShopHourRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteShopHour($id);
    }
}

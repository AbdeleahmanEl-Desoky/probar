<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Handlers;

use Modules\Barber\ScheduleShop\Repositories\ScheduleShopRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteScheduleShopHandler
{
    public function __construct(
        private ScheduleShopRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteScheduleShop($id);
    }
}

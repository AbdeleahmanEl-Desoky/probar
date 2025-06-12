<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Services;

use Illuminate\Support\Collection;
use Modules\Barber\Shop\DTO\CreateShopDTO;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

class ShopStatusService
{
    public function __construct(
        private ShopRepository $repository,
    ) {
    }

    public function updateHold(UuidInterface $id): Shop
    {
        return $this->repository->updateShopHold($id);
    }

    public function updateStatus( $id)//: Shop
    {
        return $this->repository->updateShopStatus($id);
    }

}

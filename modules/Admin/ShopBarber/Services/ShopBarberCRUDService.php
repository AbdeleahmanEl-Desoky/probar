<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ShopBarber\DTO\CreateShopBarberDTO;
use Modules\Admin\ShopBarber\Models\ShopBarber;
use Modules\Admin\ShopBarber\Repositories\ShopBarberRepository;
use Modules\Barber\Shop\Models\Shop;
use Ramsey\Uuid\UuidInterface;

class ShopBarberCRUDService
{
    public function __construct(
        private ShopBarberRepository $repository,
    ) {
    }

    public function create(CreateShopBarberDTO $createShopBarberDTO): Shop
    {
         return $this->repository->createShopBarber($createShopBarberDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10)
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }


    public function get(UuidInterface $id): ShopBarber
    {
        return $this->repository->getShopBarber(
            id: $id,
        );
    }
}

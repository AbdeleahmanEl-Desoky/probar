<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Services;

use Illuminate\Support\Collection;
use Modules\Barber\Shop\DTO\CreateShopDTO;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Ramsey\Uuid\UuidInterface;

class ShopCRUDService
{
    public function __construct(
        private ShopRepository $repository,
    ) {
    }

    public function create(CreateShopDTO $createShopDTO): Shop
    {
         return $this->repository->createShop($createShopDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Shop
    {
        return $this->repository->getShop(
            id: $id,
        );
    }
}

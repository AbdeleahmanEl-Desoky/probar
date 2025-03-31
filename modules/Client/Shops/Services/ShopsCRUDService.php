<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Services;

use Illuminate\Support\Collection;
use Modules\Barber\Shop\Models\Shop;
use Modules\Client\Shops\Repositories\ShopsRepository;
use Ramsey\Uuid\UuidInterface;

class ShopsCRUDService
{
    public function __construct(
        private ShopsRepository $repository,
    ) {
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
        return $this->repository->getShops(
            id: $id,
        );
    }
}

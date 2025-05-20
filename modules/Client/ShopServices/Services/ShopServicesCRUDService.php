<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Services;

use Illuminate\Support\Collection;
use Modules\Client\ShopServices\DTO\CreateShopServicesDTO;
use Modules\Client\ShopServices\Models\ShopServices;
use Modules\Client\ShopServices\Repositories\ShopServicesRepository;
use Ramsey\Uuid\UuidInterface;

class ShopServicesCRUDService
{
    public function __construct(
        private ShopServicesRepository $repository,
    ) {
    }


    public function list(int $page = 1, int $perPage = 10,$shop): array
    {
        return $this->repository->paginated(
            ['shop_id'=>$shop],
            page: $page,
            perPage: $perPage,
        );
    }

        public function listAll(): array
    {
        return $this->repository->all();
    }

}

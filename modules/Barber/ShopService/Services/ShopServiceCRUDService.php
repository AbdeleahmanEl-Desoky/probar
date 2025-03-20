<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Services;

use Illuminate\Support\Collection;
use Modules\Barber\ShopService\DTO\CreateShopServiceDTO;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Barber\ShopService\Repositories\ShopServiceRepository;
use Ramsey\Uuid\UuidInterface;

class ShopServiceCRUDService
{
    public function __construct(
        private ShopServiceRepository $repository,
    ) {
    }

    public function create(CreateShopServiceDTO $createShopServiceDTO): ShopService
    {
         return $this->repository->createShopService($createShopServiceDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): ShopService
    {
        return $this->repository->getShopService(
            id: $id,
        );
    }
}

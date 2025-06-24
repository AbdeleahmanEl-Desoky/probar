<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ShopsService\DTO\CreateShopsServiceDTO;
use Modules\Admin\ShopsService\Repositories\ShopsServiceRepository;
use Modules\Barber\ShopService\Models\ShopService;
use Ramsey\Uuid\UuidInterface;

class ShopsServiceCRUDService
{
    public function __construct(
        private ShopsServiceRepository $repository,
    ) {
    }

    public function create(CreateShopsServiceDTO $createShopsServiceDTO): ShopService
    {
         return $this->repository->createShopsService($createShopsServiceDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10)
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): ShopService
    {
        return $this->repository->getShopsService(
            id: $id,
        );
    }
}

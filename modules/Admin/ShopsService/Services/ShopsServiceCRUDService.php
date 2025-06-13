<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ShopsService\DTO\CreateShopsServiceDTO;
use Modules\Admin\ShopsService\Models\ShopsService;
use Modules\Admin\ShopsService\Repositories\ShopsServiceRepository;
use Ramsey\Uuid\UuidInterface;

class ShopsServiceCRUDService
{
    public function __construct(
        private ShopsServiceRepository $repository,
    ) {
    }

    public function create(CreateShopsServiceDTO $createShopsServiceDTO): ShopsService
    {
         return $this->repository->createShopsService($createShopsServiceDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): ShopsService
    {
        return $this->repository->getShopsService(
            id: $id,
        );
    }
}

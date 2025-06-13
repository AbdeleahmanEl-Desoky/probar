<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ShopsHour\DTO\CreateShopsHourDTO;
use Modules\Admin\ShopsHour\Models\ShopsHour;
use Modules\Admin\ShopsHour\Repositories\ShopsHourRepository;
use Ramsey\Uuid\UuidInterface;

class ShopsHourCRUDService
{
    public function __construct(
        private ShopsHourRepository $repository,
    ) {
    }

    public function create(CreateShopsHourDTO $createShopsHourDTO): ShopsHour
    {
         return $this->repository->createShopsHour($createShopsHourDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): ShopsHour
    {
        return $this->repository->getShopsHour(
            id: $id,
        );
    }
}

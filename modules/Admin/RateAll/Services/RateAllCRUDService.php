<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Services;

use Illuminate\Support\Collection;
use Modules\Admin\RateAll\DTO\CreateRateAllDTO;
use Modules\Admin\RateAll\Models\RateAll;
use Modules\Admin\RateAll\Repositories\RateAllRepository;
use Ramsey\Uuid\UuidInterface;

class RateAllCRUDService
{
    public function __construct(
        private RateAllRepository $repository,
    ) {
    }

    public function create(CreateRateAllDTO $createRateAllDTO): RateAll
    {
         return $this->repository->createRateAll($createRateAllDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): RateAll
    {
        return $this->repository->getRateAll(
            id: $id,
        );
    }
}

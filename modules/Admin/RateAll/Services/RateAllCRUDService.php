<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Services;

use Illuminate\Support\Collection;
use Modules\Admin\RateAll\DTO\CreateRateAllDTO;
use Modules\Admin\RateAll\Models\RateAll;
use Modules\Admin\RateAll\Repositories\RateAllRepository;
use Modules\Client\Rate\Models\Rate;
use Ramsey\Uuid\UuidInterface;

class RateAllCRUDService
{
    public function __construct(
        private RateAllRepository $repository,
    ) {
    }

    public function create(CreateRateAllDTO $createRateAllDTO): Rate
    {
         return $this->repository->createRateAll($createRateAllDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10)
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Rate
    {
        return $this->repository->getRateAll(
            id: $id,
        );
    }
}

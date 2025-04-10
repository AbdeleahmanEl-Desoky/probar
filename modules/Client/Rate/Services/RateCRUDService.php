<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Services;

use Illuminate\Support\Collection;
use Modules\Client\Rate\DTO\CreateRateDTO;
use Modules\Client\Rate\Models\Rate;
use Modules\Client\Rate\Repositories\RateRepository;
use Ramsey\Uuid\UuidInterface;

class RateCRUDService
{
    public function __construct(
        private RateRepository $repository,
    ) {
    }

    public function create(CreateRateDTO $createRateDTO): Rate
    {
         return $this->repository->createRate($createRateDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Rate
    {
        return $this->repository->getRate(
            id: $id,
        );
    }
}

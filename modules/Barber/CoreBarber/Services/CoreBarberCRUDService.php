<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Services;

use Illuminate\Support\Collection;
use Modules\Barber\CoreBarber\DTO\CreateCoreBarberDTO;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;
use Ramsey\Uuid\UuidInterface;

class CoreBarberCRUDService
{
    public function __construct(
        private CoreBarberRepository $repository,
    ) {
    }

    public function create(CreateCoreBarberDTO $createCoreBarberDTO): Barber
    {
         return $this->repository->createCoreBarber($createCoreBarberDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Barber
    {
        return $this->repository->getCoreBarber(
            id: $id,
        );
    }
}

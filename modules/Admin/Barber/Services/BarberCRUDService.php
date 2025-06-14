<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Services;

use Illuminate\Support\Collection;
use Modules\Admin\Barber\DTO\CreateBarberDTO;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Admin\Barber\Repositories\BarberRepository;
use Ramsey\Uuid\UuidInterface;

class BarberCRUDService
{
    public function __construct(
        private BarberRepository $repository,
    ) {
    }

    public function list(int $page = 1, int $perPage = 10)
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Barber
    {
        return $this->repository->getBarber(
            id: $id,
        );
    }
}

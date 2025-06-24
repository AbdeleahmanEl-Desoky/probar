<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Services;

use Illuminate\Support\Collection;
use Modules\Admin\ScheduleAll\DTO\CreateScheduleAllDTO;
use Modules\Admin\ScheduleAll\Models\ScheduleAll;
use Modules\Admin\ScheduleAll\Repositories\ScheduleAllRepository;
use Ramsey\Uuid\UuidInterface;

class ScheduleAllCRUDService
{
    public function __construct(
        private ScheduleAllRepository $repository,
    ) {
    }

    public function create(CreateScheduleAllDTO $createScheduleAllDTO): ScheduleAll
    {
         return $this->repository->createScheduleAll($createScheduleAllDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10, array $conditions = [])
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
            conditions: $conditions
        );
    }

    public function get(UuidInterface $id): ScheduleAll
    {
        return $this->repository->getScheduleAll(
            id: $id,
        );
    }
}

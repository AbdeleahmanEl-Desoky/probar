<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Illuminate\Support\Collection;
use Modules\Client\Schedule\DTO\CreateScheduleDTO;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;
use Ramsey\Uuid\UuidInterface;

class ScheduleCRUDService
{
    public function __construct(
        private ScheduleRepository $repository,
    ) {
    }

    public function create(CreateScheduleDTO $createScheduleDTO): Schedule
    {
         return $this->repository->createSchedule($createScheduleDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Schedule
    {
        return $this->repository->getSchedule(
            id: $id,
        );
    }
}

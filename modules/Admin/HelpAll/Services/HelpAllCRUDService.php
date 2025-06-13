<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Services;

use Illuminate\Support\Collection;
use Modules\Admin\HelpAll\DTO\CreateHelpAllDTO;
use Modules\Admin\HelpAll\Models\HelpAll;
use Modules\Admin\HelpAll\Repositories\HelpAllRepository;
use Ramsey\Uuid\UuidInterface;

class HelpAllCRUDService
{
    public function __construct(
        private HelpAllRepository $repository,
    ) {
    }

    public function create(CreateHelpAllDTO $createHelpAllDTO): HelpAll
    {
         return $this->repository->createHelpAll($createHelpAllDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): HelpAll
    {
        return $this->repository->getHelpAll(
            id: $id,
        );
    }
}

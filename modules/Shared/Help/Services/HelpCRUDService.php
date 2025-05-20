<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Services;

use Illuminate\Support\Collection;
use Modules\Shared\Help\DTO\CreateHelpDTO;
use Modules\Shared\Help\Models\Help;
use Modules\Shared\Help\Repositories\HelpRepository;
use Ramsey\Uuid\UuidInterface;

class HelpCRUDService
{
    public function __construct(
        private HelpRepository $repository,
    ) {
    }

    public function create(CreateHelpDTO $createHelpDTO): Help
    {
         return $this->repository->createHelp($createHelpDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Help
    {
        return $this->repository->getHelp(
            id: $id,
        );
    }
}

<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Services;

use Illuminate\Support\Collection;
use Modules\Client\CoreClient\DTO\CreateCoreClientDTO;
use Modules\Client\CoreClient\Models\Client;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;
use Ramsey\Uuid\UuidInterface;

class CoreClientCRUDService
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }

    public function create(CreateCoreClientDTO $createCoreClientDTO): Client
    {
         return $this->repository->createCoreClient($createCoreClientDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Client
    {
        return $this->repository->getCoreClient(
            id: $id,
        );
    }

}

<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Services;

use Illuminate\Support\Collection;
use Modules\Client\AuthClient\DTO\CreateAuthClientDTO;
use Modules\Client\AuthClient\Models\AuthClient;
use Modules\Client\AuthClient\Repositories\AuthClientRepository;
use Ramsey\Uuid\UuidInterface;

class AuthClientCRUDService
{
    public function __construct(
        private AuthClientRepository $repository,
    ) {
    }

    public function create(CreateAuthClientDTO $createAuthClientDTO): AuthClient
    {
         return $this->repository->createAuthClient($createAuthClientDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): AuthClient
    {
        return $this->repository->getAuthClient(
            id: $id,
        );
    }
}

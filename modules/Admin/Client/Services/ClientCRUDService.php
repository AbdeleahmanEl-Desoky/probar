<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Services;

use Illuminate\Support\Collection;
use Modules\Admin\Client\DTO\CreateClientDTO;
use Modules\Admin\Client\Repositories\ClientRepository;
use Modules\Client\CoreClient\Models\Client;
use Ramsey\Uuid\UuidInterface;

class ClientCRUDService
{
    public function __construct(
        private ClientRepository $repository,
    ) {
    }

    public function list(int $page = 1, int $perPage = 10)//: array
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Client
    {
        return $this->repository->getClient(
            id: $id,
        );
    }
}

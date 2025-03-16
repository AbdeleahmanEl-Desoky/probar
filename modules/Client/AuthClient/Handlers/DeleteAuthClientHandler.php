<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Handlers;

use Modules\Client\AuthClient\Repositories\AuthClientRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteAuthClientHandler
{
    public function __construct(
        private AuthClientRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteAuthClient($id);
    }
}

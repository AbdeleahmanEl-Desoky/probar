<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Handlers;

use Modules\Admin\Client\Repositories\ClientRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteClientHandler
{
    public function __construct(
        private ClientRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteClient($id);
    }
}

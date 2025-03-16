<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Handlers;

use Modules\Client\CoreClient\Repositories\CoreClientRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteCoreClientHandler
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteCoreClient($id);
    }
}

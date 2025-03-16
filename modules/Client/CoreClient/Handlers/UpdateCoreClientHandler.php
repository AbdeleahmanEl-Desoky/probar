<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Handlers;

use Modules\Client\CoreClient\Commands\UpdateCoreClientCommand;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;

class UpdateCoreClientHandler
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }

    public function handle(UpdateCoreClientCommand $updateCoreClientCommand)
    {
        $this->repository->updateCoreClient($updateCoreClientCommand->getId(), $updateCoreClientCommand->toArray());
    }
}

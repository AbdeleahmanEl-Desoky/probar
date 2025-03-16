<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Handlers;

use Modules\Client\AuthClient\Commands\UpdateAuthClientCommand;
use Modules\Client\AuthClient\Repositories\AuthClientRepository;

class UpdateAuthClientHandler
{
    public function __construct(
        private AuthClientRepository $repository,
    ) {
    }

    public function handle(UpdateAuthClientCommand $updateAuthClientCommand)
    {
        $this->repository->updateAuthClient($updateAuthClientCommand->getId(), $updateAuthClientCommand->toArray());
    }
}

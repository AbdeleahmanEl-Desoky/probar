<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Handlers;

use Modules\Client\CoreClient\Commands\UpdateCoreClientCfmToken;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCfmTokenCommand;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCommand;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;
use Modules\Client\CoreClient\Commands\UpdateClientLatLongCommand;

class UpdateClientLatLongHandler
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {}

    public function handle(UpdateClientLatLongCommand $command): void
    {
        $this->repository->updateLatLong($command->getId(), $command->toArray());
    }
}

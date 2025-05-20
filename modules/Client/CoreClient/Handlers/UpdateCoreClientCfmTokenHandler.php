<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Handlers;

use Modules\Client\CoreClient\Commands\UpdateCoreClientCfmToken;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCfmTokenCommand;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCommand;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;

class UpdateCoreClientCfmTokenHandler
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }

    public function handle(UpdateCoreClientCfmTokenCommand $UpdateCoreClientCfmToken)
    {
        $this->repository->updateCoreClient($UpdateCoreClientCfmToken->getId(), $UpdateCoreClientCfmToken->toArray());
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Handlers;

use Modules\Admin\Client\Commands\UpdateClientCommand;
use Modules\Admin\Client\Repositories\ClientRepository;

class UpdateClientHandler
{
    public function __construct(
        private ClientRepository $repository,
    ) {
    }

    public function handle(UpdateClientCommand $updateClientCommand)
    {
        $this->repository->updateClient($updateClientCommand->getId(), $updateClientCommand->toArray());
    }
}

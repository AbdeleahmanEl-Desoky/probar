<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Handlers;

use Modules\Admin\ShopsService\Commands\UpdateShopsServiceCommand;
use Modules\Admin\ShopsService\Repositories\ShopsServiceRepository;

class UpdateShopsServiceHandler
{
    public function __construct(
        private ShopsServiceRepository $repository,
    ) {
    }

    public function handle(UpdateShopsServiceCommand $updateShopsServiceCommand)
    {
        $this->repository->updateShopsService($updateShopsServiceCommand->getId(), $updateShopsServiceCommand->toArray());
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Handlers;

use Modules\Admin\CoreAdmin\Commands\UpdateCoreAdminCommand;
use Modules\Admin\CoreAdmin\Repositories\CoreAdminRepository;

class UpdateCoreAdminHandler
{
    public function __construct(
        private CoreAdminRepository $repository,
    ) {
    }

    public function handle(UpdateCoreAdminCommand $updateCoreAdminCommand)
    {
        $this->repository->updateCoreAdmin($updateCoreAdminCommand->getId(), $updateCoreAdminCommand->toArray());
    }
}

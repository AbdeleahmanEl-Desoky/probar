<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Handlers;

use Modules\Admin\AuthAdmin\Commands\UpdateAuthAdminCommand;
use Modules\Admin\AuthAdmin\Repositories\AuthAdminRepository;

class UpdateAuthAdminHandler
{
    public function __construct(
        private AuthAdminRepository $repository,
    ) {
    }

    public function handle(UpdateAuthAdminCommand $updateAuthAdminCommand)
    {
        $this->repository->updateAuthAdmin($updateAuthAdminCommand->getId(), $updateAuthAdminCommand->toArray());
    }
}

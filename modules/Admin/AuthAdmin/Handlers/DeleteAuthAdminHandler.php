<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Handlers;

use Modules\Admin\AuthAdmin\Repositories\AuthAdminRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteAuthAdminHandler
{
    public function __construct(
        private AuthAdminRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteAuthAdmin($id);
    }
}

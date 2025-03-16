<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Handlers;

use Modules\Admin\CoreAdmin\Repositories\CoreAdminRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteCoreAdminHandler
{
    public function __construct(
        private CoreAdminRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteCoreAdmin($id);
    }
}

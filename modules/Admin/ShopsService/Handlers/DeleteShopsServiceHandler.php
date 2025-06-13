<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Handlers;

use Modules\Admin\ShopsService\Repositories\ShopsServiceRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteShopsServiceHandler
{
    public function __construct(
        private ShopsServiceRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteShopsService($id);
    }
}

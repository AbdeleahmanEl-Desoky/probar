<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Handlers;

use Modules\Admin\RateAll\Repositories\RateAllRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteRateAllHandler
{
    public function __construct(
        private RateAllRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteRateAll($id);
    }
}

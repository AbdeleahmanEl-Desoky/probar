<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Handlers;

use Modules\Admin\ShopsHour\Repositories\ShopsHourRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteShopsHourHandler
{
    public function __construct(
        private ShopsHourRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteShopsHour($id);
    }
}

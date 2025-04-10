<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Handlers;

use Modules\Client\Rate\Repositories\RateRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteRateHandler
{
    public function __construct(
        private RateRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteRate($id);
    }
}

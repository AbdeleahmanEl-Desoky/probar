<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Handlers;

use Modules\Admin\RateAll\Commands\UpdateRateAllCommand;
use Modules\Admin\RateAll\Repositories\RateAllRepository;

class UpdateRateAllHandler
{
    public function __construct(
        private RateAllRepository $repository,
    ) {
    }

    public function handle(UpdateRateAllCommand $updateRateAllCommand)
    {
        $this->repository->updateRateAll($updateRateAllCommand->getId(), $updateRateAllCommand->toArray());
    }
}

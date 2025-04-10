<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Handlers;

use Modules\Client\Rate\Commands\UpdateRateCommand;
use Modules\Client\Rate\Repositories\RateRepository;

class UpdateRateHandler
{
    public function __construct(
        private RateRepository $repository,
    ) {
    }

    public function handle(UpdateRateCommand $updateRateCommand)
    {
        $this->repository->updateRate($updateRateCommand->getId(), $updateRateCommand->toArray());
    }
}

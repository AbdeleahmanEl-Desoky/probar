<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Handlers;

use Modules\Admin\ShopsHour\Commands\UpdateShopsHourCommand;
use Modules\Admin\ShopsHour\Repositories\ShopsHourRepository;

class UpdateShopsHourHandler
{
    public function __construct(
        private ShopsHourRepository $repository,
    ) {
    }

    public function handle(UpdateShopsHourCommand $updateShopsHourCommand)
    {
        $this->repository->updateShopsHour($updateShopsHourCommand->getId(), $updateShopsHourCommand->toArray());
    }
}

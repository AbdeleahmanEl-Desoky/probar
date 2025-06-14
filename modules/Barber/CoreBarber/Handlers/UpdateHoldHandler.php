<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Handlers;

use Modules\Barber\CoreBarber\Commands\UpdateCfmTokenCommand;
use Modules\Barber\CoreBarber\Commands\UpdateHoldCommand;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;

class UpdateHoldHandler
{
    public function __construct(
        private CoreBarberRepository $repository,
    ) {
    }

    public function handle(UpdateHoldCommand $updateHoldCommand)
    {
        $this->repository->updateCoreBarber($updateHoldCommand->getId(), $updateHoldCommand->toArray());
    }
}

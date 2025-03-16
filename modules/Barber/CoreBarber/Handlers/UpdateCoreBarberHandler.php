<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Handlers;

use Modules\Barber\CoreBarber\Commands\UpdateCoreBarberCommand;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;

class UpdateCoreBarberHandler
{
    public function __construct(
        private CoreBarberRepository $repository,
    ) {
    }

    public function handle(UpdateCoreBarberCommand $updateCoreBarberCommand)
    {
        $this->repository->updateCoreBarber($updateCoreBarberCommand->getId(), $updateCoreBarberCommand->toArray());
    }
}

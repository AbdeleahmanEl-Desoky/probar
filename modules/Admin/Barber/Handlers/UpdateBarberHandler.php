<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Handlers;

use Modules\Admin\Barber\Commands\UpdateBarberCommand;
use Modules\Admin\Barber\Repositories\BarberRepository;

class UpdateBarberHandler
{
    public function __construct(
        private BarberRepository $repository,
    ) {
    }

    public function handle(UpdateBarberCommand $updateBarberCommand)
    {
        $this->repository->updateBarber($updateBarberCommand->getId(), $updateBarberCommand->toArray());
    }
}

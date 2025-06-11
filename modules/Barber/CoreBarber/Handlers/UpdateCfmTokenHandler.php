<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Handlers;

use Modules\Barber\CoreBarber\Commands\UpdateCfmTokenCommand;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;

class UpdateCfmTokenHandler
{
    public function __construct(
        private CoreBarberRepository $repository,
    ) {
    }

    public function handle(UpdateCfmTokenCommand $updateCfmTokenCommand)
    {
        $this->repository->updateCfmToken($updateCfmTokenCommand->getId(), $updateCfmTokenCommand->toArray());
    }
}

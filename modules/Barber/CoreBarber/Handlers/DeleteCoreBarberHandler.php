<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Handlers;

use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteCoreBarberHandler
{
    public function __construct(
        private CoreBarberRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteCoreBarber($id);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Handlers;

use Modules\Admin\Barber\Repositories\BarberRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteBarberHandler
{
    public function __construct(
        private BarberRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteBarber($id);
    }
}

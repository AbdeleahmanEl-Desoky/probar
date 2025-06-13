<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Handlers;

use Modules\Admin\HelpAll\Repositories\HelpAllRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteHelpAllHandler
{
    public function __construct(
        private HelpAllRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteHelpAll($id);
    }
}

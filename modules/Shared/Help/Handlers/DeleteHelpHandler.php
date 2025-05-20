<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Handlers;

use Modules\Shared\Help\Repositories\HelpRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteHelpHandler
{
    public function __construct(
        private HelpRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteHelp($id);
    }
}

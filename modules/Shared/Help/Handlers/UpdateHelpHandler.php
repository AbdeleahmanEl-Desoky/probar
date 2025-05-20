<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Handlers;

use Modules\Shared\Help\Commands\UpdateHelpCommand;
use Modules\Shared\Help\Repositories\HelpRepository;

class UpdateHelpHandler
{
    public function __construct(
        private HelpRepository $repository,
    ) {
    }

    public function handle(UpdateHelpCommand $updateHelpCommand)
    {
        $this->repository->updateHelp($updateHelpCommand->getId(), $updateHelpCommand->toArray());
    }
}

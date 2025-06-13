<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Handlers;

use Modules\Admin\HelpAll\Commands\UpdateHelpAllCommand;
use Modules\Admin\HelpAll\Repositories\HelpAllRepository;

class UpdateHelpAllHandler
{
    public function __construct(
        private HelpAllRepository $repository,
    ) {
    }

    public function handle(UpdateHelpAllCommand $updateHelpAllCommand)
    {
        $this->repository->updateHelpAll($updateHelpAllCommand->getId(), $updateHelpAllCommand->toArray());
    }
}

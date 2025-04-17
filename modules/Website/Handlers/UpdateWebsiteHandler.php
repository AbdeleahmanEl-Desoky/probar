<?php

declare(strict_types=1);

namespace Modules\Website\Handlers;

use Modules\Website\Commands\UpdateWebsiteCommand;
use Modules\Website\Repositories\WebsiteRepository;

class UpdateWebsiteHandler
{
    public function __construct(
        private WebsiteRepository $repository,
    ) {
    }

    public function handle(UpdateWebsiteCommand $updateWebsiteCommand)
    {
        $this->repository->updateWebsite($updateWebsiteCommand->getId(), $updateWebsiteCommand->toArray());
    }
}

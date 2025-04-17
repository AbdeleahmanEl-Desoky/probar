<?php

declare(strict_types=1);

namespace Modules\Website\Handlers;

use Modules\Website\Repositories\WebsiteRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteWebsiteHandler
{
    public function __construct(
        private WebsiteRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteWebsite($id);
    }
}

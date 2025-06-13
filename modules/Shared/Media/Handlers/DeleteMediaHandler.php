<?php

declare(strict_types=1);

namespace Modules\Shared\Media\Handlers;

use Modules\Shared\Media\Repositories\MediaRepository;

class DeleteMediaHandler
{
    public function __construct(
        private MediaRepository $repository,
    ) {
    }

    public function handle($ids): void
    {
        $this->repository->deleteMedia($ids);
    }
}

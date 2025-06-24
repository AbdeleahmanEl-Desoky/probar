<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Services;

use Modules\Shared\Version\Models\Version;
use Modules\Shared\Version\Repositories\VersionRepository;
use Ramsey\Uuid\UuidInterface;

class VersionCRUDService
{
    public function __construct(
        private VersionRepository $repository,
    ) {
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get()
    {
        return $this->repository->getVersion();
    }
}

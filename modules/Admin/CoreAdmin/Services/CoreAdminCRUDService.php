<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Services;

use Illuminate\Support\Collection;
use Modules\Admin\CoreAdmin\DTO\CreateCoreAdminDTO;
use Modules\Admin\CoreAdmin\Models\CoreAdmin;
use Modules\Admin\CoreAdmin\Repositories\CoreAdminRepository;
use Ramsey\Uuid\UuidInterface;

class CoreAdminCRUDService
{
    public function __construct(
        private CoreAdminRepository $repository,
    ) {
    }

    public function create(CreateCoreAdminDTO $createCoreAdminDTO): CoreAdmin
    {
         return $this->repository->createCoreAdmin($createCoreAdminDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): CoreAdmin
    {
        return $this->repository->getCoreAdmin(
            id: $id,
        );
    }
}

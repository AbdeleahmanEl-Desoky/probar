<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Services;

use Illuminate\Support\Collection;
use Modules\Admin\AuthAdmin\DTO\CreateAuthAdminDTO;
use Modules\Admin\AuthAdmin\Models\AuthAdmin;
use Modules\Admin\AuthAdmin\Repositories\AuthAdminRepository;
use Ramsey\Uuid\UuidInterface;

class AuthAdminCRUDService
{
    public function __construct(
        private AuthAdminRepository $repository,
    ) {
    }

    public function create(CreateAuthAdminDTO $createAuthAdminDTO): AuthAdmin
    {
         return $this->repository->createAuthAdmin($createAuthAdminDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): AuthAdmin
    {
        return $this->repository->getAuthAdmin(
            id: $id,
        );
    }
}

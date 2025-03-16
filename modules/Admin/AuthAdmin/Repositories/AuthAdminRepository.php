<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\AuthAdmin\Models\AuthAdmin;

/**
 * @property AuthAdmin $model
 * @method AuthAdmin findOneOrFail($id)
 * @method AuthAdmin findOneByOrFail(array $data)
 */
class AuthAdminRepository extends BaseRepository
{
    public function __construct(AuthAdmin $model)
    {
        parent::__construct($model);
    }

    public function getAuthAdminList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getAuthAdmin(UuidInterface $id): AuthAdmin
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createAuthAdmin(array $data): AuthAdmin
    {
        return $this->create($data);
    }

    public function updateAuthAdmin(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteAuthAdmin(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

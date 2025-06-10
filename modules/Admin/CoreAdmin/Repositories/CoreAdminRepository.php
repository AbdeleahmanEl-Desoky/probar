<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\CoreAdmin\Models\User;

/**
 * @property User $model
 * @method CoreAdmin findOneOrFail($id)
 * @method CoreAdmin findOneByOrFail(array $data)
 */
class CoreAdminRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getCoreAdminList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getCoreAdmin(UuidInterface $id): User
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createCoreAdmin(array $data): User
    {
        return $this->create($data);
    }

    public function updateCoreAdmin(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteCoreAdmin(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

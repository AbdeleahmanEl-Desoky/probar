<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Shared\Version\Models\Version;

/**
 * @property Version $model
 * @method Version findOneOrFail($id)
 * @method Version findOneByOrFail(array $data)
 */
class VersionRepository extends BaseRepository
{
    public function __construct(Version $model)
    {
        parent::__construct($model);
    }

    public function getVersionList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getVersion()
    {
        return $this->model->first();
    }

    public function createVersion(array $data): Version
    {
        return $this->create($data);
    }

    public function updateVersion(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteVersion(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

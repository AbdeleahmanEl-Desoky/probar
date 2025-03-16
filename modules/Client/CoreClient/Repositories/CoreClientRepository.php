<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\CoreClient\Models\CoreClient;

/**
 * @property CoreClient $model
 * @method CoreClient findOneOrFail($id)
 * @method CoreClient findOneByOrFail(array $data)
 */
class CoreClientRepository extends BaseRepository
{
    public function __construct(CoreClient $model)
    {
        parent::__construct($model);
    }

    public function getCoreClientList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getCoreClient(UuidInterface $id): CoreClient
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createCoreClient(array $data): CoreClient
    {
        return $this->create($data);
    }

    public function updateCoreClient(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteCoreClient(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

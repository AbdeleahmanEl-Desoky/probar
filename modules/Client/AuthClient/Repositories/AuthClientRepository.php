<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\AuthClient\Models\AuthClient;

/**
 * @property AuthClient $model
 * @method AuthClient findOneOrFail($id)
 * @method AuthClient findOneByOrFail(array $data)
 */
class AuthClientRepository extends BaseRepository
{
    public function __construct(AuthClient $model)
    {
        parent::__construct($model);
    }

    public function getAuthClientList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getAuthClient(UuidInterface $id): AuthClient
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createAuthClient(array $data): AuthClient
    {
        return $this->create($data);
    }

    public function updateAuthClient(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteAuthClient(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\Client\Models\Client;

/**
 * @property Client $model
 * @method Client findOneOrFail($id)
 * @method Client findOneByOrFail(array $data)
 */
class ClientRepository extends BaseRepository
{
    public function __construct(Client $model)
    {
        parent::__construct($model);
    }

    public function getClientList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getClient(UuidInterface $id): Client
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createClient(array $data): Client
    {
        return $this->create($data);
    }

    public function updateClient(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteClient(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\CoreClient\Models\Client;

/**
 * @property Client $model
 * @method CoreClient findOneOrFail($id)
 * @method CoreClient findOneByOrFail(array $data)
 */
class CoreClientRepository extends BaseRepository
{
    public function __construct(Client $model)
    {
        parent::__construct($model);
    }

    public function getCoreClientList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getCoreClient(UuidInterface $id): Client
    {
        return $this->model->where('id', $id->toString())->firstOrFail();
    }

    public function createCoreClient(array $data): Client
    {
        return $this->create($data);
    }

    public function updateCoreClient(UuidInterface $id, array $data): bool
    {
        $client = $this->getCoreClient($id);

        if (!$client) {
            return false;
        }
        if (isset($data['file']) && $data['file'] instanceof \Illuminate\Http\UploadedFile) {
            $client->clearMediaCollection('profile_pictures');
            
            $client->addMedia($data['file'])
                ->toMediaCollection('profile_pictures');
        }

        $client->update(array_filter([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'] ?? null,
        ]));

        return true;
    }


    public function deleteCoreClient(UuidInterface $id): bool
    {
        return $this->delete($id);
    }

    public function getCoreClientByEmail( $email):Client
    {
        return $this->model->where('email', $email)->firstOrFail();
    }
}

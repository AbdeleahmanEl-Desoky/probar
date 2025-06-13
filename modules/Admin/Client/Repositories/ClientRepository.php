<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Client\CoreClient\Models\Client;
use Ramsey\Uuid\UuidInterface;

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

    public function paginateds(int $page = 1, int $perPage = 10): array
    {
        $query = Client::query()
            ->withCount([
                'schedules as canceled_schedules_count' => fn($q) => $q->where('status', 'cancel'),
                'schedules as active_schedules_count' => fn($q) => $q->whereNotIn('status', ['finished', 'cancel']),
                'schedules as finished_schedules_count' => fn($q) => $q->where('status', 'finished'),
            ])
            ->with('media'); // if you're using Spatie Media Library for picture_url

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        return [
            'data' => $paginator->getCollection(),
            'pagination' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
            ],
        ];
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

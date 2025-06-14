<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Barber\Shop\Models\Shop;

/**
 * @property Shop $model
 * @method ShopBarber findOneOrFail($id)
 * @method ShopBarber findOneByOrFail(array $data)
 */
class ShopBarberRepository extends BaseRepository
{
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return Shop::query()
            ->withCount([
                'schedules as canceled_schedules_count' => fn($q) => $q->where('status', 'cancel'),
                'schedules as active_schedules_count' => fn($q) => $q->whereNotIn('status', ['finished', 'cancel']),
                'schedules as finished_schedules_count' => fn($q) => $q->where('status', 'finished'),
            ])
            ->with('media')
            ->paginate($perPage, ['*'], 'page', $page);
    }
    public function getShopBarberList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getShopBarber(UuidInterface $id): Shop
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopBarber(array $data): Shop
    {
        return $this->create($data);
    }

    public function updateShopBarber(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopBarber(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

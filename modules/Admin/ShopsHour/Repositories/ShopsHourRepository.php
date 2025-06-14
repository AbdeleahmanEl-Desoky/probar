<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\ShopsHour\Models\ShopsHour;
use Modules\Barber\ShopHour\Models\ShopHour;

/**
 * @property ShopsHour $model
 * @method ShopsHour findOneOrFail($id)
 * @method ShopsHour findOneByOrFail(array $data)
 */
class ShopsHourRepository extends BaseRepository
{
    public function __construct(ShopsHour $model)
    {
        parent::__construct($model);
    }

    public function getShopsHourList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return ShopHour::query()
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function getShopsHour(UuidInterface $id): ShopsHour
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createShopsHour(array $data): ShopsHour
    {
        return $this->create($data);
    }

    public function updateShopsHour(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteShopsHour(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

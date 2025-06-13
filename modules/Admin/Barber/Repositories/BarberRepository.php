<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\Barber\Models\Barber;

/**
 * @property Barber $model
 * @method Barber findOneOrFail($id)
 * @method Barber findOneByOrFail(array $data)
 */
class BarberRepository extends BaseRepository
{
    public function __construct(Barber $model)
    {
        parent::__construct($model);
    }

    public function getBarberList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getBarber(UuidInterface $id): Barber
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createBarber(array $data): Barber
    {
        return $this->create($data);
    }

    public function updateBarber(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteBarber(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

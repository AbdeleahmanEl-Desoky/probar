<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\ScheduleAll\Models\ScheduleAll;
use Modules\Client\Schedule\Models\Schedule;

/**
 * @property ScheduleAll $model
 * @method ScheduleAll findOneOrFail($id)
 * @method ScheduleAll findOneByOrFail(array $data)
 */
class ScheduleAllRepository extends BaseRepository
{
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }

    public function getScheduleAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function paginateds(int $page = 1, int $perPage = 10, array $conditions = [])
    {
        $query = $this->model->newQuery()
            ->with(['shopServices', 'shop', 'client']);

        if (method_exists($this->model, 'scopeFilter')) {
            $query = $query->filter(request()->all())->where($conditions);
        } else {
            $query = $query->where($conditions);
        }

        return $query->orderBy('schedule_date', 'desc')
                    ->paginate($perPage, ['*'], 'page', $page);
    }

    public function getScheduleAll(UuidInterface $id): ScheduleAll
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createScheduleAll(array $data): ScheduleAll
    {
        return $this->create($data);
    }

    public function updateScheduleAll(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteScheduleAll(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

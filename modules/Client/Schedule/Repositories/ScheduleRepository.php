<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Client\Schedule\Models\ScheduleService;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Schedule\Models\Schedule;

/**
 * @property Schedule $model
 * @method Schedule findOneOrFail($id)
 * @method Schedule findOneByOrFail(array $data)
 */
class ScheduleRepository extends BaseRepository
{
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }

    public function getScheduleList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getSchedule(UuidInterface $id): Schedule
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createSchedule(array $data): Schedule
    {
        $schedule =$this->create($data);

        foreach ($data['services'] as $service){
            ScheduleService::create([
                'schedule_id'=>$schedule->id,
                'shop_service_id' =>$service
            ]);
        }

        return $schedule;

    }

    public function updateSchedule(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteSchedule(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}

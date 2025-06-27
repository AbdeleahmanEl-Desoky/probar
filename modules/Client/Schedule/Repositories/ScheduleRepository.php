<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Carbon\Carbon;
use GPBMetadata\Google\Api\Service;
use Illuminate\Database\Eloquent\Collection;
use Modules\Barber\ShopService\Models\ShopService;
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
        return $this->findOneByWithRelations(['id' => $id->toString()],['shopServices','shop']);
    }

    public function createSchedule(array $data): Schedule
    {
        $schedule =$this->create($data);

        foreach ($data['services'] as $serviceId){
            ScheduleService::create([
                'schedule_id'=>$schedule->id,
                'shop_service_id' =>$serviceId,
                'price' =>  ShopService::find($serviceId)->price ?? 0
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
    public function getHoldByShopId(UuidInterface $shopId)
    {
        $scheduleCount = $this->model->where('shop_id', $shopId->toString())
            ->where('schedule_date', Carbon::now()->format('Y-m-d'))
            ->count();
    
        $scheduleCountHold = $this->model->where('shop_id', $shopId->toString())
            ->whereNotNull('hold')
            ->where('hold', '!=', 0)
            ->where('schedule_date', Carbon::now()->format('Y-m-d'))
            ->count();
    
        $schedule = null;
    
        if ($scheduleCount == $scheduleCountHold) {
            $schedule = $this->model->where('shop_id', $shopId->toString())
                ->whereNotNull('hold')
                ->where('hold', '!=', 0)
                ->where('schedule_date', Carbon::now()->format('Y-m-d'))
                ->first();
        }
    
        return $schedule ? (int) $schedule->hold : 0;
    }
}

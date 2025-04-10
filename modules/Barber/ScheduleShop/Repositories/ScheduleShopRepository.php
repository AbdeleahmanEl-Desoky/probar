<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Modules\Client\Rate\Models\Rate;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Schedule\Models\Schedule;

/**
 * @property Schedule $model
 * @method ScheduleShop findOneOrFail($id)
 * @method ScheduleShop findOneByOrFail(array $data)
 */
class ScheduleShopRepository extends BaseRepository
{
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }

    public function getScheduleShopList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getScheduleShop(UuidInterface $id): Schedule
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createScheduleShop(array $data): Schedule
    {
        return $this->create($data);
    }

    public function updateScheduleShop(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteScheduleShop(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
    public function mostSellingServices(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)
    {
        $query = Schedule::with('shopServices')
        ->where('schedules.shop_id', $shopId);

    if ($startDate) {
        $query->where('schedule_date', '>=', $startDate);
    }

    if ($endDate) {
        $query->where('schedule_date', '<=', $endDate);
    }

    $result = $query->paginate($perPage, ['*'], 'page', $page);

    // Get the shop services from the result
    $services = [];
    foreach ($result->items() as $schedule) {
        foreach ($schedule->shopServices as $service) {
            $serviceId = $service->id;
            if (!isset($services[$serviceId])) {
                $services[$serviceId] = [
                    'name' => $service->translations->firstWhere('locale', 'en')->content ?? 'N/A',
                    'description'=> $service->description,
                    'picture_url' => $service->getFirstMediaUrl('shop_service'),
                    'count' => 0
                ];
            }
            $services[$serviceId]['count']++;
        }
    }

    // Convert the services to a sorted array based on the count
  return  $sortedServices = collect($services)
        ->sortByDesc('count')
        ->values()
        ->all();

    }
    public function rate(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)//: array
    {
        $query = Rate::where('shop_id', $shopId);

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

       return $ratingCounts = $query->select('rate')
            ->groupBy('rate')
            ->selectRaw('rate, COUNT(*) as count')
            ->get();

    }
    public function totalEarning(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)//: array
    {
        $query = $this->model->where('shop_id', $shopId);

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }
        $totalEarnings = $query->sum('total_price');

        return [
            'total_earnings' => $totalEarnings,
        ];
    }

}

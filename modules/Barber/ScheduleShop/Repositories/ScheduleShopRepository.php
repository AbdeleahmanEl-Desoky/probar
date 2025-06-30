<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Modules\Barber\Shop\Models\Shop;
use Modules\Client\Rate\Models\Rate;
use Ramsey\Uuid\UuidInterface;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Models\ScheduleService;
use Modules\Shared\Notification\Services\FirebaseNotificationService;

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

    public function createScheduleShop(array $data): Schedule
    {
        return $this->create($data);
    }

    public function updateScheduleShop(UuidInterface $id, array $data): bool
    {
        // Get the existing schedule shop by ID
        $schedule = $this->find($id); // Ensure 'find' exists and returns the model

        // Sum all service prices related to the schedule
        $baseTotal = $schedule->shopServicesHasMany->sum('price');

        // Get optional additions and discounts, fallback to 0 if not set
        $addition = $data['addition'] ?? 0;
        $discount = $data['discount'] ?? 0;

        // Calculate new total price (prevent negative totals)
        $newTotal = max(0, ($baseTotal + $addition) - $discount);

        // Set total_price into the data array
        $data['total_price'] = $newTotal;

        // Update the schedule
        return $this->update($id, $data);
    }


    public function updateScheduleShopPaymentBooking(UuidInterface $id): bool
    {
        $schedule = $this->find($id);
      return  $schedule->update([
            'payment' => 'cash_payed'
        ]);
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
                    'picture_url' => $service?->getFirstMediaUrl('shop_service')?? null,
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

        return $totalEarnings;
    }

    public function totalCashPayed(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)//: array
    {
        $query = $this->model->where('shop_id', $shopId)->where('payment','cash_payed');

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }
        $totalCashPayed = $query->sum('total_price');

        return $totalCashPayed;
    }

    public function totalCityLedger(string $shopId, ?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 10)//: array
    {
        $query = $this->model->where('shop_id', $shopId)->where('payment','city_ledger');

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }
        $totalCityLedger = $query->sum('total_price');

        return $totalCityLedger;
    }

    public function updateHold(UuidInterface $id)
    {
        $schedule = $this->model->where('id', $id)->first();

        if (!$schedule) {
            return null;
        }

        $shopId = $schedule->shop_id;

        $scheduleDate = Carbon::parse($schedule->schedule_date)->toDateString();
        $startTime = $schedule->start_time;
        $hold = $schedule->hold ?? 0;
        $shopHold =$schedule->shop->hold ?? 0;
        $newHold = $hold + $shopHold;

        // Step 1: Get all affected schedules (on same shop & date and after or at the current start time)
        $affectedSchedules = $this->model->with('shop')
            ->where('shop_id', $shopId)
            ->whereDate('schedule_date', $scheduleDate)
            ->where('start_time', '>=', $startTime)
            ->get();

        // Step 2: Update the hold for all affected schedules
        $this->model
            ->whereIn('id', $affectedSchedules->pluck('id'))
            ->update(['hold' => $newHold]);


        // Step 3: Notify each affected client
        foreach ($affectedSchedules as $affectedSchedule) {
            $fcmToken = $affectedSchedule->client->fcm_token ?? null;

            if ($fcmToken) {
                FirebaseNotificationService::send(
                    $fcmToken,
                    __('notifications.hold_schedule_title_client'),
                    __('notifications.hold_schedule_body_client', [
                        'shop_name' => $affectedSchedule->shop->name ?? '',
                        'hold' => $newHold,
                        'time' => Carbon::parse($affectedSchedule->start_time)->format('H:i'),
                        'date' => Carbon::parse($affectedSchedule->schedule_date)->format('d/m'),
                    ]),
                    [
                        'type' => 'schedule_hold',
                        'schedule_id' => $affectedSchedule->id,
                    ]
                );
            }
                FirebaseNotificationService::send(
                    auth('api_barbers')->user()->fcm_token??'@',
                    __('notifications.hold_schedule_title'),
                    __('notifications.hold_schedule_body', [
                        'hold' => $newHold,
                    ]),
                    [
                        'type' => 'schedule_hold',
                        'schedule_id' => $affectedSchedule->id,
                    ]
                );

        }

        return $schedule;
    }
    public function updateHoldAll(UuidInterface $shopId)
    {
        $now = Carbon::now();

        $scheduleDate = $now->toDateString();
        $startTime = $now->toTimeString();    // Current time
        $newHold = Shop::find($shopId)->hold ?? 0; // Get the shop's hold value

        // Step 1: Get all today's schedules after now for the shop
        $affectedSchedules = $this->model->with(['shop', 'client'])
            ->where('shop_id', $shopId)
            ->whereDate('schedule_date', $scheduleDate)
            ->where('start_time', '>=', $startTime)
            ->get();

        // Step 2: Update the hold for all affected schedules
        foreach ($affectedSchedules as $schedule) {
            $schedule->hold = ($schedule->hold ?? 0) + $newHold;
            $schedule->save();

            // Step 3: Notify the client
            $fcmToken = $schedule->client->fcm_token ?? null;

            if ($fcmToken) {
                FirebaseNotificationService::send(
                    $fcmToken,
                    __('notifications.hold_schedule_title_client'),
                    __('notifications.hold_schedule_body_client', [
                        'shop_name' => $schedule->shop->name ?? '',
                        'hold' => $schedule->hold,
                        'time' => Carbon::parse($schedule->start_time)->format('H:i'),
                        'date' => Carbon::parse($schedule->schedule_date)->format('d/m'),
                    ]),
                    [
                        'type' => 'schedule_hold',
                        'schedule_id' => $schedule->id,
                    ]
                );
            }

            // Step 4: Notify the barber (auth user)
            FirebaseNotificationService::send(
                auth('api_barbers')->user()->fcm_token ?? '@',
                __('notifications.hold_schedule_title'),
                __('notifications.hold_schedule_body', [
                    'hold' => $schedule->hold,
                ]),
                [
                    'type' => 'schedule_hold',
                    'schedule_id' => $schedule->id,
                ]
            );
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Hold time updated for all future schedules today.',
            'count' => $affectedSchedules->count(),
        ]);
    }



    public function updateHoldOneSchedule(UuidInterface $id)
    {
        $schedule = $this->model->where('id', $id)->first();

        if (!$schedule) {
            return null;
        }

        $hold = $schedule->hold ?? 0;
        $newHold = $hold + 10;

        $fcmToken = $schedule->client->fcm_token ?? null;

        $schedule->update([
            'hold'=>$newHold
        ]);

        if ($fcmToken) {
            FirebaseNotificationService::send(
                $fcmToken,
                __('notifications.hold_schedule_title_client'),
                __('notifications.hold_schedule_body_client', [
                    'shop_name' => $affectedSchedule->shop->name ?? '',
                    'hold' => $newHold,
                    'time' => Carbon::parse($schedule->start_time)->format('H:i'),
                    'date' => Carbon::parse($schedule->schedule_date)->format('d/m'),
                ]),
                [
                    'type' => 'schedule_hold',
                    'schedule_id' => $schedule->id,
                ]
            );
        }
        FirebaseNotificationService::send(
            auth('api_barbers')->user()->fcm_token??'@',
            __('notifications.hold_schedule_title'),
            __('notifications.hold_schedule_body', [
                'hold' => $newHold,
            ]),
            [
                'type' => 'schedule_hold',
                'schedule_id' => $schedule->id,
            ]
        );



        return $schedule;
    }

}

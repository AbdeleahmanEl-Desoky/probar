<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class GetScheduleDataService
{
    private ScheduleRepository $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }
    public function getBookingDetails($request): array
    {
        $shopId = $request->shop_id;
        $scheduleDate = $request->schedule_date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        $serviceIds = $request->services;


        $services = ShopService::whereIn('id', $serviceIds)->get();

        $subtotal = 0;
        $servicesDetails = [];

        foreach ($services as $service) {
            $subtotal += $service->price;
            $servicesDetails[] = [
                'service_name' => $service->name,
                'service_description' => $service->shopService->description,
                'price' => $service->price,
                'picture_url' => $service->getFirstMediaUrl('shop_service')
            ];
        }

        $discount = 0;
        $total = $subtotal - $discount;

        return [
            'schedule_date' => $scheduleDate,
            'start_time' => $this->formatTime($startTime,Uuid::fromString($shopId)),
            'end_time' =>  $this->formatTime($endTime,Uuid::fromString($shopId)),
            'services' => $servicesDetails,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ];
    }


    private function formatTime(string $time, UuidInterface $shopId): string
    {
        $hold = $this->scheduleRepository->getHoldByShopId($shopId);

        return Carbon::parse($time)
            ->addMinutes($hold)
            ->format('H:i');
    }

}

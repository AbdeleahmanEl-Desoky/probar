<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;

class GetScheduleDataService
{
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
                'price' => $service->price,
                'picture_url' => $service->getFirstMediaUrl('shop_service')
            ];
        }

        $discount = 0;
        $total = $subtotal - $discount;

        return [
            'schedule_date' => $scheduleDate,
            'start_time' => $this->formatTime($startTime, $shopId),
            'end_time' =>  $this->formatTime($endTime, $shopId),
            'services' => $servicesDetails,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ];
    }

    private function formatTime(string $time, int $shopId): string
    {
        $hold = \Modules\Barber\Shop\Models\Shop::find($shopId)?->hold ?? 0;

        return Carbon::parse($time)
            ->addMinutes($hold)
            ->format('H:i');
    }

}

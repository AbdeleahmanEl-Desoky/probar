<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Models\ScheduleService;
use Modules\Client\Schedule\Repositories\ScheduleRepository;
use Ramsey\Uuid\UuidInterface;
class ScheduleCheckoutService
{
    public function getBookingDetails( $scheduleId)//: array
    {
        $services = ScheduleService::with('shopService')->where('schedule_id', $scheduleId)->get();

        $subtotal = 0;
        $servicesDetails = [];

        foreach ($services as $service) {
            $subtotal += $service->shopService->price;
            $servicesDetails[] = [
                'service_name' => $service->shopService->name,
                'service_description' => $service->shopService->description,
                'price' => $service->shopService->price,
            ];
        }

        $discount = 0;
        $total = $subtotal - $discount;

        return [
            'services' => $servicesDetails,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ];
    }



}

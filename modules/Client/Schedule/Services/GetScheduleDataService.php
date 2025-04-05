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
    public function getBookingDetails($request)
    {

        $shopId = $request->shop_id;
        $scheduleDate = $request->schedule_date;
        $serviceIds = $request->services;

        $services = ShopService::whereIn('id', $serviceIds)->get();


        // Calculate the subtotal
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
        // // Check if there is a coupon attached to the booking
        // $discount = 0;
        // if ($booking->coupon) {
        //     $coupon = $booking->coupon;

        //     // Apply the discount based on the coupon type (percentage or flat amount)
        //     if ($coupon->discount_type === 'percentage') {
        //         $discount = ($subtotal * $coupon->discount_amount) / 100;
        //     } else {
        //         $discount = $coupon->discount_amount;
        //     }
        // }

        // Calculate total after discount
        $total = $subtotal - $discount;

        return response()->json([
            'services' => $servicesDetails,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
        ]);
    }


}

<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopHour\Models\ShopHourDetail;
use Modules\Client\Schedule\Models\Schedule;

class GetScheduleSlotsService
{
    public function get($shopId, $date = null)
    {
        $shop = Shop::find($shopId);
        if (!$shop || $shop->is_open != 1) {
            return [];
        }

        $date = $date ? Carbon::parse($date) : Carbon::today();
        $dayOfWeek = $date->format('l');

        $shopHour = ShopHour::where('shop_id', $shopId)
            ->where('day', $dayOfWeek)
            ->where('status',1)
            ->first();

        if (!$shopHour) {
            return [];
        }
        $detailsQuery = ShopHourDetail::where('shop_id', $shopId)
        ->where('day', $dayOfWeek)
        ->where('status', 1)
        ->orderBy('start_time', 'asc');
    
        if ($date->isToday()) {
            $detailsQuery->where('start_time', '>=', Carbon::now()->format('H:i'));
        }
        
        $details = $detailsQuery->get();
    
        if ($details->isEmpty()) {
            return [];
        }

        $timeSlots = [];

        foreach ($details as $detail) {
          $slotStartFormatted = $detail->start_time;
           $slotEndFormatted = $detail->end_time;
                $booking = Schedule::where('shop_id', $shopId)
                    ->whereDate('schedule_date', $date)
                    ->whereTime('start_time', $slotStartFormatted)
                    ->get();

                $bookingCount = $booking->count();
                $workerNo = $shop->worker_no;

                $timeSlots[] = [
                    'from' => $slotStartFormatted,
                    'to' => $slotEndFormatted,
                    'status' => $bookingCount >= $workerNo ? 'pending' : 'available',
                    'booking' => $booking,
                ];
        }

        return $timeSlots;
    }
}

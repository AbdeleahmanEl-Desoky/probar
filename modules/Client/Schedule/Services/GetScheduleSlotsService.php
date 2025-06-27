<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopHour\Models\ShopHourDetail;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;

class GetScheduleSlotsService
{
    private ScheduleRepository $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function get($shopId, $date = null)
    {
        $shop = Shop::find($shopId);
        if (!$shop || $shop->is_open != 1) {
            return [];
        }

        
        $date = $date ? Carbon::parse($date) : Carbon::today();

        $hold = $this->scheduleRepository->getHoldByShopId($shopId,$date);
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
                    'show'=>    Carbon::parse($slotStartFormatted)
                    ->addMinutes($hold)
                    ->format('H:i'),


                    'to' => $slotEndFormatted,
                    'status' => $bookingCount >= $workerNo ? 'pending' : 'available',
                    'booking' => $booking,
                ];
        }

        return $timeSlots;
    }
}

<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;

class GetScheduleSlotsService
{
    public function __construct(
        private ScheduleRepository $repository,
        private ScheduleCRUDService $scheduleService,
    ) {
    }

    public function get($shopId, $date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();
        $dayOfWeek = $date->format('l');

        $shopHour = ShopHour::with(['details' => function ($query) {
                $query->orderBy('start_time', 'asc');
            }])
            ->where('shop_id', $shopId)
            ->where('day', $dayOfWeek)
            ->where('status',1)
            ->first();
        $shop = Shop::find($shopId);
        if (!$shop || $shop->is_open != 1) {
            return ['message' => 'Shop is closed today'];
        }

        if (!$shopHour) {
            return ['message' => 'Shop is closed today'];
        }

        $strtoTime = $shopHour->strto_time ?? '+30 minutes'; // default fallback
        $timeSlots = [];

        foreach ($shopHour->details as $detail) {
            $start = strtotime($detail->start_time);
            $end = strtotime($detail->end_time);

            while ($start < $end) {
                $slotEnd = strtotime($strtoTime, $start);

                if ($slotEnd > $end) break;

                $slotStartFormatted = date('H:i', $start);
                $slotEndFormatted = date('H:i', $slotEnd);

                if ($date->isToday() && $slotStartFormatted <= now()->format('H:i')) {
                    $start = $slotEnd;
                    continue;
                }

                $booking = Schedule::where('shop_id', $shopId)
                    ->whereDate('schedule_date', $date)
                    ->whereTime('start_time', $slotStartFormatted)
                    ->select('id', 'start_time', 'end_time', 'schedule_date', 'shop_id', 'client_id', 'status', 'note')
                    ->first();

                $timeSlots[] = [
                    'from' => $slotStartFormatted,
                    'to' => $slotEndFormatted,
                    'status' => $booking ? 'pending' : 'available',
                    'booking' => $booking ?? null,
                ];

                $start = $slotEnd;
            }
        }


        return $timeSlots;
    }


}

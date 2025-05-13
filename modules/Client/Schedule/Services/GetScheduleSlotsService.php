<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Carbon\Carbon;
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

    public function get($shopId,$date=null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();
        $dayOfWeek = $date->format('l');

        $shopHour = ShopHour::with(['details' => function ($query) {
                $query->orderBy('start_time', 'asc');
            }])
            ->where('shop_id', $shopId)
            ->where('day', $dayOfWeek)
            ->first();

        if (!$shopHour) {
            return ['message' => 'Shop is closed today'];
        }

        $timeSlots = [];

        foreach ($shopHour->details as $detail) {
            $start = Carbon::createFromFormat('H:i', $detail->start_time);
            $end = Carbon::createFromFormat('H:i', $detail->end_time);

            while ($start < $end) {
                $slotEnd = (clone $start)->addMinutes(30);
                if ($slotEnd > $end) break;

                $booking = Schedule::where('shop_id', $shopId)
                    ->whereDate('schedule_date', $date)
                    ->whereTime('start_time', $start->format('H:i'))
                    ->select('id','start_time','end_time','schedule_date','shop_id','client_id','status','note')
                    // ->filter(request()->all())
                    ->first();

                $timeSlots[] = [
                    'from' => $start->format('H:i'),
                    'to' => $slotEnd->format('H:i'),
                    'status' => $booking ? 'pending' : 'available',
                    'booking' => $booking ?? null,
                ];

                $start = $slotEnd;
            }
        }

        return $timeSlots;
    }

}

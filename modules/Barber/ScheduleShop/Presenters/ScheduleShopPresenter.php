<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Presenters;

use Modules\Barber\ScheduleShop\Models\ScheduleShop;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Carbon\Carbon;
use Modules\Client\Schedule\Models\Schedule;

class ScheduleShopPresenter extends AbstractPresenter
{
    private Schedule $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->schedule->id,
            'start_time' => Carbon::parse($this->schedule->start_time)
                ->addMinutes($this->schedule->hold ?? 0)
                ->format('H:i'),
            'end_time' => Carbon::parse($this->schedule->end_time)
                ->addMinutes($this->schedule->hold ?? 0)
                ->format('H:i'),
            'schedule_date' => $this->schedule->schedule_date,
            'shop_id' => $this->schedule->shop_id,
            'client_id' => $this->schedule->client_id,
            'guest_name' => $this->schedule->guest_name,
            'guest_phone' => $this->schedule->guest_phone,
            'status' => $this->schedule->status,
            'note' => $this->schedule->note,
            'name' => $this->schedule?->client?->name ?? $this->schedule->guest_name,
            'shop_rate' => $this->schedule->shop->rate,
            'payment' => $this->schedule->payment,
            'picture_url' => $this->schedule->shop->getFirstMediaUrl('shops'),
            'shop_services' => $this->schedule->shopServices->map(function ($service) {
                return [
                    'price' => $service->price,
                    'name' => $service->name,
                    'description' => $service->description,
                    'picture_url' => $service->getFirstMediaUrl('shop_service')
                ];
            }),
        ];
    }
}

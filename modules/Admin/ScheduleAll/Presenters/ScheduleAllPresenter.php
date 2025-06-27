<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Presenters;

use Modules\Admin\ScheduleAll\Models\ScheduleAll;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Carbon\Carbon;
use Modules\Client\Schedule\Models\Schedule;

class ScheduleAllPresenter extends AbstractPresenter
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
            'status' => $this->schedule->status,
            'note' => $this->schedule->note,
            'shop_name' => $this->schedule->shop?->name,
            'client_name' => $this->schedule->client?->name ?? $this->schedule->guest_name,
            'client_phone' => $this->schedule->client?->phone ?? $this->schedule->guest_phone,
            'city'=> $this->schedule->shop?->city?->name??null,
            'address_1' => $this->schedule->shop?->address_1,
            'address_2' => $this->schedule->shop?->address_2,
            'shop_rate' => $this->schedule->shop->average_rating,
            'total_rates' => $this->schedule->shop->total_rates,
            'rate' => $this->schedule->rate,
            'payment' =>$this->schedule->payment,

            'shop_services' => $this->schedule->shopServices->map(function ($service) {
                return [
                    'price' => $service->price,
                    'name' => $service->name,
                    'description' => $service->description,
                    'picture_url' => $service?->getFirstMediaUrl('shop_service')
                ];
            }),
        ];
    }
}

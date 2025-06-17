<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Presenters;

use Modules\Client\Schedule\Models\Schedule;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Carbon\Carbon;

class ScheduleActivePresenter extends AbstractPresenter
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
            'name' => $this->schedule->shop->name,
            'city'=> $this->schedule->shop?->city?->name??null,
            'address_1' => $this->schedule->shop?->address_1,
            'address_2' => $this->schedule->shop?->address_2,
            'shop_rate' => $this->schedule->shop->rate,
            'payment' =>$this->schedule->payment,
            'picture_url' => $this->schedule->shop->getFirstMediaUrl('shops'),
            'rote' => $this->schedule->rate,
            'shop_services' => $this->schedule->shopServices->map(function ($service) {
                return [
                    'price' => $service->price,
                    'name' => $service->name,
                    'description' => $service->description,
                    'picture_url' => $service->getFirstMediaUrl('shop_service')
                ];
            }),
            // 'shop_service_price'=> $this->schedule->shop->shopServices->price,
            // 'shop_service_name'=> $this->schedule->shop->shopServices->name,
            // 'shop_service_description'=> $this->schedule->shop->shopServices->description,
        ];
    }
}

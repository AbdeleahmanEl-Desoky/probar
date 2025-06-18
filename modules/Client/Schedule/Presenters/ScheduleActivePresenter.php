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
                $startTime = Carbon::parse($this->schedule->schedule_date . ' ' . $this->schedule->start_time)
            ->addMinutes($this->schedule->hold ?? 0);
        $endTime = Carbon::parse($this->schedule->schedule_date . ' ' . $this->schedule->end_time)
            ->addMinutes($this->schedule->hold ?? 0);

        $now = Carbon::now();

        if ($now->greaterThanOrEqualTo($endTime)) {
            $remainingTime = __('schedule.ended');
        } else {
            $diff = $now->diff($endTime);

            $days = $diff->d;
            $hours = $diff->h;
            $minutes = $diff->i;

            $parts = [];

            if ($days > 0) {
                $label = $days === 1 ? __('schedule.day') : __('schedule.days');
                $parts[] = "$days $label";
            }
            if ($hours > 0) {
                $label = $hours === 1 ? __('schedule.hour') : __('schedule.hours');
                $parts[] = "$hours $label";
            }
            if ($minutes > 0) {
                $label = $minutes === 1 ? __('schedule.minute') : __('schedule.minutes');
                $parts[] = "$minutes $label";
            }

            $remainingTime = __('schedule.remaining_prefix') . ' ' . implode(' ' . __('schedule.and') . ' ', $parts);
        }
        return [
            'id' => $this->schedule->id,

            'start_time' => Carbon::parse($this->schedule->start_time)
                ->addMinutes($this->schedule->hold ?? 0)
                ->format('H:i'),
            'end_time' => Carbon::parse($this->schedule->end_time)
                ->addMinutes($this->schedule->hold ?? 0)
                ->format('H:i'),
            'schedule_date' => $this->schedule->schedule_date,
            'remaining_time' => $remainingTime,
            'shop_id' => $this->schedule->shop_id,
            'client_id' => $this->schedule->client_id,
            'status' => $this->schedule->status,
            'note' => $this->schedule->note,
            'name' => $this->schedule->shop->name,
            'city'=> $this->schedule->shop?->city?->name??null,
            'address_1' => $this->schedule->shop?->address_1,
            'address_2' => $this->schedule->shop?->address_2,
            'longitude' => $this->schedule->shop?->longitude,
            'latitude' => $this->schedule->shop?->latitude,
            'shop_rate' => $this->schedule->shop->rate,
            'payment' =>$this->schedule->payment,
            'picture_url' => $this->schedule->shop->getFirstMediaUrl('shops'),
            'rote' => $this->schedule->rate?->rate??null,
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

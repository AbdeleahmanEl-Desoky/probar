<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Presenters;

use Modules\Client\Schedule\Models\Schedule;
use BasePackage\Shared\Presenters\AbstractPresenter;

class SchedulePresenter extends AbstractPresenter
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
            'start_time' => $this->schedule->start_time ,
            'end_time' => $this->schedule->end_time ,
            'schedule_date' => $this->schedule->schedule_date ,
            'shop_id' => $this->schedule->shop_id ,
            'client_id' => $this->schedule->client_id ,
            'status' => $this->schedule->status ,
            'note' => $this->schedule->note ,
            'name' => $this->schedule->shop->name,
            'city'=> $this->schedule->shop?->city?->name??null,
            'address_1' => $this->schedule->shop?->address_1,
            'address_2' => $this->schedule->shop?->address_2,
            'shop_rate' => $this->schedule->shop?->rate,
            'payment' =>$this->schedule->payment,
            'picture_url' => $this->schedule->shop->getFirstMediaUrl('shops'),
        ];
    }
}

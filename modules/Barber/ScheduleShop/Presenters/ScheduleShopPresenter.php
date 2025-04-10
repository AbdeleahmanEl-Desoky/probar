<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Presenters;

use Modules\Barber\ScheduleShop\Models\ScheduleShop;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ScheduleShopPresenter extends AbstractPresenter
{
    private ScheduleShop $scheduleShop;

    public function __construct(ScheduleShop $scheduleShop)
    {
        $this->scheduleShop = $scheduleShop;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->scheduleShop->id,
            'name' => $this->scheduleShop->name,
        ];
    }
}

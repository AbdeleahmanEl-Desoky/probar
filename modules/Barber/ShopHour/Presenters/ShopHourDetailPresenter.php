<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Presenters;

use Modules\Barber\ShopHour\Models\ShopHour;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\ShopHour\Models\ShopHourDetail;

class ShopHourDetailPresenter extends AbstractPresenter
{
    private ShopHourDetail $shopHour;

    public function __construct(ShopHourDetail $shopHour)
    {
        $this->shopHour = $shopHour;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopHour->id,
            'shop_hour_id' => $this->shopHour->shop_hour_id,
            'status' => $this->shopHour->status,
            'start_time' => $this->shopHour->start_time,
            'end_time' => $this->shopHour->end_time,
        ];
    }
}

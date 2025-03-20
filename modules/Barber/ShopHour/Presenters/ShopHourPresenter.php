<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Presenters;

use Modules\Barber\ShopHour\Models\ShopHour;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ShopHourPresenter extends AbstractPresenter
{
    private ShopHour $shopHour;

    public function __construct(ShopHour $shopHour)
    {
        $this->shopHour = $shopHour;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopHour->id,
            'shop_id' => $this->shopHour->shop_id,
            'status' => $this->shopHour->status,
            'day' => $this->shopHour->day,
            'opening_time' => $this->shopHour->opening_time,
            'closing_time' => $this->shopHour->closing_time,
            // 'details'   => $this->shopHour->details,
        ];
    }
}

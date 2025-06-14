<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Presenters;

use Modules\Barber\Shop\Models\Shop;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\ShopHour\Presenters\ShopHourPresenter;
use Modules\Client\Rate\Presenters\RatePresenter;
use Modules\Shared\Media\Presenters\MediaPresenter;

class ShopDetailsPresenter extends AbstractPresenter
{
    private Shop $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shop->id,
            'name' => $this->shop->name,
            'description' => $this->shop->description,

            'name_en' => $this->shop->getTranslation('name', 'en'),
            'name_ar' => $this->shop->getTranslation('name', 'ar'),

            'description_en' => $this->shop->getTranslation('description', 'en'),
            'description_ar'=> $this->shop->getTranslation('description', 'ar'),

            'worker_no'=> $this->shop->worker_no,
            'city_id'=> $this->shop->city_id,
            'street'=> $this->shop->street,
            'address_1'=> $this->shop->address_1,
            'address_2'=> $this->shop->address_2,
            'files' => MediaPresenter::collection($this->shop->getMedia('shops')), //array
            'average_rates' => $this->shop->average_rating,
            'total_rates' => $this->shop->total_rates,
            'is_open' => $this->shop->is_open,
            'longitude'=> $this->shop->longitude,
            'latitude'=> $this->shop->latitude,
            'is_favorited' => $this->shop->is_favorited,
            'rates' => $this->shop->rates? RatePresenter::collection($this->shop->rates): [],
            'shop_hours' => $this->shop->shopHours
            ? $this->shop->shopHours
                ->sortBy(fn($item) => array_search($item->day, [
                    'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
                ]))
                ->map(fn($hour) => (new ShopHourPresenter($hour))->getData())
                ->values()
                ->toArray()
            : [],
            'whatsapp' => $this->shop->whatsapp,
            'facebook' => $this->shop->facebook,
            'instagram' => $this->shop->instagram,
        ];
    }
}

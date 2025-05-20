<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Presenters;

use Modules\Barber\Shop\Models\Shop;
use BasePackage\Shared\Presenters\AbstractPresenter;
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
        ];
    }
}

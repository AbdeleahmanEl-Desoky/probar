<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Presenters;

use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopHour\Presenters\ShopHourPresenter;
use Modules\Client\Shops\Services\ShopsFormatDistanceService;

class ShopsPresenter extends AbstractPresenter
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
                'picture_url' => $this->shop->getFirstMediaUrl('shops'),
                'rate'=>'5',
                'is_open'=>$this->shop->is_open,
                'is_favorited' => $this->shop->is_favorited,
                'longitude'=> $this->shop->longitude,
                'latitude'=> $this->shop->latitude,
                'distance' => ShopsFormatDistanceService::formatDistance(
                    ShopsFormatDistanceService::calculateDistance(
                        auth('api_clients')->user()->latitude,
                        auth('api_clients')->user()->longitude,
                        $this->shop->latitude,
                        $this->shop->longitude
                    )
                ),

            ];
    }
}

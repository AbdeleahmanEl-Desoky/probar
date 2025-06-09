<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Presenters;

use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\Shop\Models\Shop;
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
        $client = auth('api_clients')->user();

        $clientLatitude = $client?->latitude;
        $clientLongitude = $client?->longitude;

        $distance = null;

        if (
            $clientLatitude !== null && $clientLongitude !== null &&
            $this->shop->latitude !== null && $this->shop->longitude !== null
        ) {
            $distance = ShopsFormatDistanceService::formatDistance(
                ShopsFormatDistanceService::calculateDistance(
                    (float) $clientLatitude,
                    (float) $clientLongitude,
                    (float) $this->shop->latitude,
                    (float) $this->shop->longitude
                )
            );
        }

        return [
            'id' => $this->shop->id,
            'name' => $this->shop->name,
            'description' => $this->shop->description,
            'worker_no' => $this->shop->worker_no,
            'city_id' => $this->shop->city_id,
            'street' => $this->shop->street,
            'address_1' => $this->shop->address_1,
            'address_2' => $this->shop->address_2,
            'picture_url' => $this->shop->getFirstMediaUrl('shops'),
            'rate' => '5',
            'is_open' => $this->shop->is_open,
            'is_favorited' => $this->shop->is_favorited,
            'longitude' => $this->shop->longitude,
            'latitude' => $this->shop->latitude,
            'distance' => $distance,
            'whatsapp' => $this->shop->whatsapp,
            'facebook' => $this->shop->facebook,
            'instagram' => $this->shop->instagram,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Presenters;

use Modules\Client\ShopServices\Models\ShopServices;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\ShopService\Models\ShopService;

class ShopServicesPresenter extends AbstractPresenter
{
    private ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopService->id,
            'name' => $this->shopService->name,
            'description'=> $this->shopService->description,
            'price' =>  $this->shopService->price,
            'time'  => $this->shopService->time,
            'picture_url' => $this->shopService?->getFirstMediaUrl('shop_service')?? null
        ];
    }
}

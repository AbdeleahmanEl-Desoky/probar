<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Presenters;

use Modules\Client\ShopServices\Models\ShopServices;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\ShopService\Models\ShopService;

class ShopServicesfilterPresenter extends AbstractPresenter
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
        ];
    }
}

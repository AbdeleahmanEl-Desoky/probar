<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Presenters;

use Modules\Admin\ShopsService\Models\ShopsService;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\ShopService\Models\ShopService;

class ShopsServicePresenter extends AbstractPresenter
{
    private ShopService $shopsService;

    public function __construct(ShopService $shopsService)
    {
        $this->shopsService = $shopsService;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopsService->id,
            'name' => $this->shopsService->name,
            'description'=> $this->shopsService->description,
            'price' =>  $this->shopsService->price,
            'time'  => $this->shopsService->time,
            'picture_url' => $this->shopsService->getFirstMediaUrl('shop_service'),
             'shop_name' => $this->shopsService->shop?->name
        ];
    }
}

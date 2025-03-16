<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Presenters;

use Modules\Barber\Shop\Models\Shop;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ShopPresenter extends AbstractPresenter
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
        ];
    }
}

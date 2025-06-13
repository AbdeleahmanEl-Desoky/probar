<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Presenters;

use Modules\Admin\ShopBarber\Models\ShopBarber;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ShopBarberPresenter extends AbstractPresenter
{
    private ShopBarber $shopBarber;

    public function __construct(ShopBarber $shopBarber)
    {
        $this->shopBarber = $shopBarber;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopBarber->id,
            'name' => $this->shopBarber->name,
        ];
    }
}

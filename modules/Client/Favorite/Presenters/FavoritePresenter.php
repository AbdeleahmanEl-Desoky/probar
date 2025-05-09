<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Presenters;

use Modules\Client\Favorite\Models\Favorite;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\Shop\Presenters\ShopPresenter;

class FavoritePresenter extends AbstractPresenter
{
    private Favorite $favorite;

    public function __construct(Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->favorite->id,
            'shop' => $this->favorite->shop ? (new ShopPresenter($this->favorite->shop))->getData() : null,

        ];
    }
}

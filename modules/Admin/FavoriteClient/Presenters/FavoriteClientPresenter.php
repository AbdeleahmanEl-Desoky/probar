<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Presenters;

use Modules\Admin\FavoriteClient\Models\FavoriteClient;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Client\Favorite\Models\Favorite;

class FavoriteClientPresenter extends AbstractPresenter
{
    private Favorite $favoriteClient;

    public function __construct(Favorite $favoriteClient)
    {
        $this->favoriteClient = $favoriteClient;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->favoriteClient->id,
            'client' => $this->favoriteClient->client?->name,
            'shop_name' => $this->favoriteClient->shop?->name,
            'worker_no' => $this->favoriteClient->shop?->worker_no,
            'city_name'=> $this->favoriteClient->shop?->city_id ,
            'average_rating' => $this->favoriteClient?->shop?->average_rating,
            'total_rates' => $this->favoriteClient->total_rates,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Presenters;

use Modules\Admin\FavoriteClient\Models\FavoriteClient;
use BasePackage\Shared\Presenters\AbstractPresenter;

class FavoriteClientPresenter extends AbstractPresenter
{
    private FavoriteClient $favoriteClient;

    public function __construct(FavoriteClient $favoriteClient)
    {
        $this->favoriteClient = $favoriteClient;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->favoriteClient->id,
            'name' => $this->favoriteClient->name,
        ];
    }
}

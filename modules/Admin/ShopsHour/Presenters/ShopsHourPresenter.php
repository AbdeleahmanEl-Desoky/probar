<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Presenters;

use Modules\Admin\ShopsHour\Models\ShopsHour;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ShopsHourPresenter extends AbstractPresenter
{
    private ShopsHour $shopsHour;

    public function __construct(ShopsHour $shopsHour)
    {
        $this->shopsHour = $shopsHour;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopsHour->id,
            'name' => $this->shopsHour->name,
        ];
    }
}

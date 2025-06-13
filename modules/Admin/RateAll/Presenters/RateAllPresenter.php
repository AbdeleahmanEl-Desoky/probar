<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Presenters;

use Modules\Admin\RateAll\Models\RateAll;
use BasePackage\Shared\Presenters\AbstractPresenter;

class RateAllPresenter extends AbstractPresenter
{
    private RateAll $rateAll;

    public function __construct(RateAll $rateAll)
    {
        $this->rateAll = $rateAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->rateAll->id,
            'name' => $this->rateAll->name,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Presenters;

use Modules\Client\Rate\Models\Rate;
use BasePackage\Shared\Presenters\AbstractPresenter;

class RatePresenter extends AbstractPresenter
{
    private Rate $rate;

    public function __construct(Rate $rate)
    {
        $this->rate = $rate;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->rate->id,
            'shop_id' => $this->rate->shop_id,
            'schedule_id' => $this->rate->schedule_id,
            'client_id' => $this->rate->client_id,
            'note' => $this->rate->note,
            'rate' => $this->rate->rate,
        ];
    }
}

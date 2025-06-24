<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Presenters;

use Modules\Admin\RateAll\Models\RateAll;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Client\Rate\Models\Rate;

class RateAllPresenter extends AbstractPresenter
{
    private Rate $rateAll;

    public function __construct(Rate $rateAll)
    {
        $this->rateAll = $rateAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->rateAll->id,
            'shop_name' => $this->rateAll->shop->name ?? null,
            'client_name' => $this->rateAll->client->name ?? null,
            'schedule_date' => $this->rateAll->schedule->schedule_date ?? null,
            'schedule_start_time' => $this->rateAll->schedule->start_time ?? null,
            'schedule_end_time' => $this->rateAll->schedule->end_time ?? null,
            'note' => $this->rateAll->note,
            'rate' => $this->rateAll->rate,

        ];
    }

}

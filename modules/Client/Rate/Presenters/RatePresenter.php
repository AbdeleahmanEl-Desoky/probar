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
            'shop_name' => $this->rate->shop->name,
            'schedule_id' => $this->rate->schedule_id,
            'client_id' => $this->rate->client_id,
            'client_name' => $this->rate->client->name,
            'client_picture' => $this->rate->client->getFirstMediaUrl('profile_pictures'),
            'note' => $this->rate->note,
            'rate' => $this->rate->rate,
        ];
    }
}

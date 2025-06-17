<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Presenters;


use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\Shop\Models\Shop;

class ShopBarberPresenter extends AbstractPresenter
{
    private Shop $shopBarber;

    public function __construct(Shop $shopBarber)
    {
        $this->shopBarber = $shopBarber;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->shopBarber->id,
            'name' => $this->shopBarber->name,
            'worker_no' => $this->shopBarber->worker_no,
            'city_name'=> $this->shopBarber->city_id ,
            'street' => $this->shopBarber->street,
            'address_1'=> $this->shopBarber->address_1,
            'address_2' => $this->shopBarber->address_2,
            'is_open' => $this->shopBarber->is_open,
            'featured'=> $this->shopBarber->featured,
            'picture_url' => $this->shopBarber->getFirstMediaUrl('profile_pictures'),
            'canceled_schedules_count' => $this->shopBarber->canceled_schedules_count,
            'active_schedules_count' => $this->shopBarber->active_schedules_count,
            'finished_schedules_count' => $this->shopBarber->finished_schedules_count,
            'shop_hours' => $this->shopBarber->shopHours,
            'average_rating' => $this->shopBarber->average_rating,
        ];
    }
}

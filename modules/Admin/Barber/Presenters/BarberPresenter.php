<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Presenters;

use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\CoreBarber\Models\Barber;

class BarberPresenter extends AbstractPresenter
{
    private Barber $barber;

    public function __construct(Barber $barber)
    {
        $this->barber = $barber;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->barber->id,
            'name' => $this->barber->name,
            'email' => $this->barber->email,
            'phone' => $this->barber->phone,
            'is_active' => $this->barber->is_active,
            'picture_url' => $this->barber->getFirstMediaUrl('profile_pictures'),
            'canceled_schedules_count' => $this->barber->canceled_schedules_count,
            'active_schedules_count' => $this->barber->active_schedules_count,
            'finished_schedules_count' => $this->barber->finished_schedules_count,
        ];
    }
}

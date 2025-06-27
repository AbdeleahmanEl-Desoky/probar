<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Presenters;

use Modules\Barber\CoreBarber\Models\Barber;
use BasePackage\Shared\Presenters\AbstractPresenter;

class CoreBarberPresenter extends AbstractPresenter
{
    private Barber $coreBarber;

    public function __construct(Barber $coreBarber)
    {
        $this->coreBarber = $coreBarber;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->coreBarber->id,
            'name' => $this->coreBarber->name,
            'email' => $this->coreBarber->email,
            'phone' => $this->coreBarber->phone,
            'picture_url' => $this->coreBarber?->getFirstMediaUrl('profile_pictures'),
            'is_active' => $this->coreBarber->is_active,
        ];
    }
}

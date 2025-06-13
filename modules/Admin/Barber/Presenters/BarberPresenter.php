<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Presenters;

use Modules\Admin\Barber\Models\Barber;
use BasePackage\Shared\Presenters\AbstractPresenter;

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
        ];
    }
}

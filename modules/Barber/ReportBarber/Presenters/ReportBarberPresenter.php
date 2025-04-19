<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Presenters;

use Modules\Barber\ReportBarber\Models\ReportBarber;
use BasePackage\Shared\Presenters\AbstractPresenter;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Client\Report\Models\Report;

class ReportBarberPresenter extends AbstractPresenter
{
    private Report $barber;

    public function __construct(Report $barber)
    {
        $this->barber = $barber;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->barber->id,
        ];
    }
}

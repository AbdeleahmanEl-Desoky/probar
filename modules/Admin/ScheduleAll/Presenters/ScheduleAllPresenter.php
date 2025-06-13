<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Presenters;

use Modules\Admin\ScheduleAll\Models\ScheduleAll;
use BasePackage\Shared\Presenters\AbstractPresenter;

class ScheduleAllPresenter extends AbstractPresenter
{
    private ScheduleAll $scheduleAll;

    public function __construct(ScheduleAll $scheduleAll)
    {
        $this->scheduleAll = $scheduleAll;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->scheduleAll->id,
            'name' => $this->scheduleAll->name,
        ];
    }
}

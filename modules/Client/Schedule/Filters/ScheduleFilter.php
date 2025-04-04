<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ScheduleFilter extends SearchModelFilter
{
    public $relations = [];

    public function name($name)
    {
        return $this->where('name', $name);
    }
    public function scheduleDate($schedule_date)
    {
        return $this->where('schedule_date', $schedule_date);
    }

}

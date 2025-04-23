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
    public function upcoming($upcoming)
    {
        return $this->when($upcoming == 'yes',function($q){
            $q->whereDate('schedule_date', '>=', now()->toDateString())
            ->whereNotIn('status', ['booked', 'cancel']);
        });
    }
    public function active($active)
    {
        return $this->when($active == 'yes',function($q){
            $q->whereDate('schedule_date', '>=', now()->toDateString())
            ->where('status','booked');
        });
    }
    public function history($history)
    {
        return $this->when($history == 'yes',function($q){
            $q->whereDate('schedule_date', '<=', now()->toDateString())
            ->whereNot('status','booked');
        });
    }

}

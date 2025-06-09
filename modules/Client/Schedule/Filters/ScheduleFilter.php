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
            $q->whereDate('schedule_date', '>',now()->toDateString())
            ->where('status', 'pending');
        });
    }
    public function active($active)
    {
        if(auth('api_barbers')->check()){
            return $this->when($active == 'yes',function($q){
                $q->whereNotIn('status', ['finished', 'cancel'])->whereDate('schedule_date',now()->toDateString());
            });
        }else{
            return $this->when($active == 'yes',function($q){
                        $q->whereNotIn('status', ['finished', 'cancel']);
                    });
        }

    }

    public function history($history)
    {
        return $this->when($history == 'yes', function ($q) {
            $q->where(function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereDate('schedule_date', '<', now()->toDateString())
                            ->where('status', 'pending');
                })->orWhere(function ($subQuery) {
                    $subQuery->where('status', '!=', 'pending');
                });
            });
        });
    }

    public function fromDate($from_date)
    {
        return $this->whereDate('schedule_date', '>=', $from_date);
    }

    public function toDate($to_date)
    {
        return $this->whereDate('schedule_date', '<=', $to_date);
    }

    public function payment($payment)
    {
        return $this->where('payment',$payment);
    }
}

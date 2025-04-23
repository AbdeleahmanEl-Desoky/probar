<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ScheduleShopFilter extends SearchModelFilter
{
       public $relations = [];

        public function start_time($start_time)
        {
            return $this->where('start_time', $start_time);
        }
        
}

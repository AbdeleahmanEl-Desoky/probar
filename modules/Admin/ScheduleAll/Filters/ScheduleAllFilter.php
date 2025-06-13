<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ScheduleAllFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

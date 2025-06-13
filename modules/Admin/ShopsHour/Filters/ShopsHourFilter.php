<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopsHourFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

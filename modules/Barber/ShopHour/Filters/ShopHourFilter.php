<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopHourFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

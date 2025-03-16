<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

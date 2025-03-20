<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopServiceFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

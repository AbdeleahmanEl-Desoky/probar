<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopServicesFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ShopBarberFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

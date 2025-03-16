<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class BarberFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

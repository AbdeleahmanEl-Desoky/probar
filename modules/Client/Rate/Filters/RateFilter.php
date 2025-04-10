<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class RateFilter extends SearchModelFilter
{
       public $relations = [];

        // public function name($name)
        // {
        //     return $this->where('name', $name);
        // }
}

<?php

declare(strict_types=1);

namespace Modules\Website\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class WebsiteFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

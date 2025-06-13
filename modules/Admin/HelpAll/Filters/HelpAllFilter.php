<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class HelpAllFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class HelpFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

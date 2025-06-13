<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ClientFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

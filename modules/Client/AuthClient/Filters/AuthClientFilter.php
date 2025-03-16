<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class AuthClientFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

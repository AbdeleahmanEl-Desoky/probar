<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class AuthAdminFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

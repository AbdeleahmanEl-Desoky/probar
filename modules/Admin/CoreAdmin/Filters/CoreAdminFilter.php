<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class CoreAdminFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class ReportAllFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

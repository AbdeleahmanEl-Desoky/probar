<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class FavoriteClientFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class FavoriteFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

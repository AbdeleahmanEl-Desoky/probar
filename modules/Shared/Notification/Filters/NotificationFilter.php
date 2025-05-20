<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Filters;

use BasePackage\Shared\Filters\SearchModelFilter;

class NotificationFilter extends SearchModelFilter
{
       public $relations = [];

        public function name($name)
        {
            return $this->where('name', $name);
        }
}

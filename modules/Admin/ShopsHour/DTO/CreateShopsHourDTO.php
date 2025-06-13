<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopsHourDTO
{
    public function __construct(
        public string $name,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}

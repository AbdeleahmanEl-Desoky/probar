<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateScheduleAllDTO
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

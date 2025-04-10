<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateScheduleShopDTO
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

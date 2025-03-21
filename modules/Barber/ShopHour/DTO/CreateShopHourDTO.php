<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopHourDTO
{

    public function __construct(
        public array  $custom_hours,
        public string $opening_time,
        public string $closing_time,
    ) {
    }

    public function toArray(): array
    {
        return [
            'custom_hours' => $this->custom_hours,
            'closing_time' => $this->closing_time,
            'opening_time' => $this->opening_time,
        ];
    }

}

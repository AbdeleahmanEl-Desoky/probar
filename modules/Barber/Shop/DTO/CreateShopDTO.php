<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopDTO
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

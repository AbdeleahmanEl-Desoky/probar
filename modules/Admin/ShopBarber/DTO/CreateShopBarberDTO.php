<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopBarberDTO
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

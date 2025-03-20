<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopServiceDTO
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

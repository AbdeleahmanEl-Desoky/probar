<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopServiceDTO
{
    public function __construct(
        public array  $name,
        private ?array  $description,
        private int $time,
        private int $price,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description'=>  $this->description,
            'price'=>  $this->price,
            'time'=> $this->time,
        ];
    }
}

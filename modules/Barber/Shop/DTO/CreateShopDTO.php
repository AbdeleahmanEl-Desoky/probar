<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\DTO;

use Ramsey\Uuid\Type\Decimal;
use Ramsey\Uuid\UuidInterface;

class CreateShopDTO
{
    public ?string $id;

    public function __construct(
        public array  $name,
        private array  $description,
        private int $worker_no,
        private string $city_id,
        private string $street,
        private string $address_1,
        public ?string $address_2,
        public ?float $latitude,
        public ?float $longitude
        ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'worker_no'=> $this->worker_no,
            'city_id'=> $this->city_id,
            'street'=> $this->street,
            'address_1'=> $this->address_1,
            'address_2'=> $this->address_2,
            'latitude' => $this->latitude,
            'longitude'=> $this->longitude
        ];
    }
}

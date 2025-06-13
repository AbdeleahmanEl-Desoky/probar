<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\DTO;

class CreateShopDTO
{
    public function __construct(
        public ?array $name = null,
        public ?array $description = null,
        public ?int $worker_no = null,
        public ?string $city_id = null,
        public ?string $street = null,
        public ?string $address_1 = null,
        public ?string $address_2 = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $whatsapp = null,
        public ?string $facebook = null,
        public ?string $instagram = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'description' => $this->description,
            'worker_no' => $this->worker_no,
            'city_id' => $this->city_id,
            'street' => $this->street,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
        ], fn ($value) => !is_null($value));
    }
}

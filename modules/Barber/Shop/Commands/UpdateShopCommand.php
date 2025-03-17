<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateShopCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $description,
        private int $worker_no,
        private string $city_id,
        private string $street,
        private string $address_1,
        public ?string $address_2,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'barber_id'=> $this->barber_id,
            'description' => $this->description,
            'worker_no'=> $this->worker_no,
            'city_id'=> $this->city_id,
            'street'=> $this->street,
            'address_1'=> $this->address_1,
            'address_2'=> $this->address_2,
        ]);
    }
}

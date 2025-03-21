<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateShopServiceCommand
{
    public function __construct(
        private UuidInterface $id,
        private array $name,
        private array $description,
        private int $price,
        private int $time,
        public ?string $shop_id = null // Make shop_id optional
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): array
    {
        return $this->name;
    }

    public function getDescription(): array
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'time' => $this->time,
            'shop_id' => $this->shop_id,
        ]);
    }
}

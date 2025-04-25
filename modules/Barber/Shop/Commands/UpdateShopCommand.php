<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateShopCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $latitude,
        private string $longitude
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
            'latitude' => $this->latitude,
            'longitude'=> $this->longitude,
        ]);
    }
}

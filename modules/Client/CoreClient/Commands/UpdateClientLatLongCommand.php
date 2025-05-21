<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Commands;


use Ramsey\Uuid\UuidInterface;

class UpdateClientLatLongCommand
{
    public function __construct(
        private UuidInterface $id,
        private float $latitude,
        private float $longitude,
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}

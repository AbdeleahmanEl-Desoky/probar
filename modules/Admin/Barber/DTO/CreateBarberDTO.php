<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateBarberDTO
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

<?php

declare(strict_types=1);

namespace Modules\Admin\Client\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateClientDTO
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

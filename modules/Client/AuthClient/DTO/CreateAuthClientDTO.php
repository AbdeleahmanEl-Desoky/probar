<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateAuthClientDTO
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

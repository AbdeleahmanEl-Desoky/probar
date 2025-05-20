<?php

declare(strict_types=1);

namespace Modules\Shared\Help\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateHelpDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message,
        public string $type,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}

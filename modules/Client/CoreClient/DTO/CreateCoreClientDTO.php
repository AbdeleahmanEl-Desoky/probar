<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateCoreClientDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $phone,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password'=> $this->password,
            'phone' => $this->phone
        ];
    }
}

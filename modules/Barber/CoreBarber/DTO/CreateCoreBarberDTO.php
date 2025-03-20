<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateCoreBarberDTO
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

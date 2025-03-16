<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateCoreBarberCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $email,
        private ?string $password
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
            'email' => $this->email,
            'password' => $this->password,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateAuthAdminDTO
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

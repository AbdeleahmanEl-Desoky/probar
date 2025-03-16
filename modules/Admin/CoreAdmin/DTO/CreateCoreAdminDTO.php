<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateCoreAdminDTO
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

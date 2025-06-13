<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateShopsServiceDTO
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

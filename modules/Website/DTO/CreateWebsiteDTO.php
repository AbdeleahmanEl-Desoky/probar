<?php

declare(strict_types=1);

namespace Modules\Website\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateWebsiteDTO
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

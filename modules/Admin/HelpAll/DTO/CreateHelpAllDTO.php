<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateHelpAllDTO
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

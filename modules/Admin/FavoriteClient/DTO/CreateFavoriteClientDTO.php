<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateFavoriteClientDTO
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

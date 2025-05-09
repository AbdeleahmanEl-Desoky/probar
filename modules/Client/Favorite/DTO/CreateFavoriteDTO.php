<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateFavoriteDTO
{
    public function __construct(
        public string $shop_id,
        public string $client_id,

    ) {
    }

    public function toArray(): array
    {
        return [
            'shop_id' => $this->shop_id,
            'client_id' => $this->client_id,
        ];
    }
}

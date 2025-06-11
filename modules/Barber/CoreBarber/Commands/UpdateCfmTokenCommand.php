<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateCfmTokenCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $fcm_token,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }


    public function toArray(): array
    {
        return array_filter([
            'fcm_token' => $this->fcm_token,
        ]);
    }
}

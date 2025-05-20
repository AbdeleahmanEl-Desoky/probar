<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateCoreClientCfmTokenCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $cfmToken,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }


    public function toArray(): array
    {
        return array_filter([
            'cfm_token' => $this->cfmToken,
        ]);
    }
}

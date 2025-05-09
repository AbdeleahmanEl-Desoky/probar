<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateScheduleCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $status = 'cancel',
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }



    public function toArray(): array
    {
        return array_filter([
            'status' => 'cancel',
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateScheduleShopStatusCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $status,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
        ]);
    }
}

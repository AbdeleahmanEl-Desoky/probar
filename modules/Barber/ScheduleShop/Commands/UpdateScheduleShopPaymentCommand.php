<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateScheduleShopPaymentCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $payment,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return array_filter([
            'payment' => $this->payment,
        ]);
    }
}

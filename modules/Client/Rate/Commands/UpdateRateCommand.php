<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateRateCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $shop_id,
        private string $schedule_id,
        private string $client_id,
        private ? string $note,
        private ? string $rate,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return array_filter([
            'shop_id' => $this->shop_id,
            'schedule_id' => $this->schedule_id,
            'client_id' => $this->client_id,
            'note' => $this->note,
            'rate' => $this->rate,
        ]);
    }
}

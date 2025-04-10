<?php

declare(strict_types=1);

namespace Modules\Client\Rate\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateRateDTO
{
    public function __construct(
        public string $shop_id,
        public string $schedule_id,
        public ?string $client_id,
        public ?string $note,
        public ?int $rate,
    ) {
    }

    public function toArray(): array
    {
        return [
            'shop_id'     => $this->shop_id,
            'schedule_id' => $this->schedule_id,
            'client_id'   => $this->client_id,
            'note'        => $this->note,
            'rate'        => $this->rate,
        ];
    }
}

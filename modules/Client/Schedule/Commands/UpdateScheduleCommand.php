<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateScheduleCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $start_time,
        private string $end_time,
        private string $schedule_date,
        private string $shop_id,
        private string $client_id,
        private string $status,
        private string $note,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }



    public function toArray(): array
    {
        return array_filter([
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'schedule_date' => $this->schedule_date,
            'shop_id' => $this->shop_id,
            'client_id' => $this->client_id,
            'status' => $this->status,
            'note' => $this->note
        ]);
    }
}

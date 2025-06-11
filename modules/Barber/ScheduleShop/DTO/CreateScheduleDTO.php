<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateScheduleDTO
{
    public function __construct(
        public string $start_time,
        public string $end_time,
        public string $schedule_date,
        public string $shop_id,
        public string $status,
        public ?string $note,
        public array $services,
        public ?string $guest_name = null,
        public ?string $guest_phone = null,
    ) {
    }

    public function toArray(): array
    {
        return [
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'schedule_date' => $this->schedule_date,
            'shop_id' => $this->shop_id,
            'status' => $this->status,
            'note' => $this->note,
            'services' => $this->services,
            'guest_name' => $this->guest_name,
            'guest_phone' => $this->guest_phone,
        ];
    }
}

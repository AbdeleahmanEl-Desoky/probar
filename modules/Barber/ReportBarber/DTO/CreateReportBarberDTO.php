<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateReportBarberDTO
{
    public function __construct(
        public string $shop_id,
        public string $schedule_id,
        public string $user_id,
        public ?string $type,
        public ?string $note,
    ) {
    }

    public function toArray(): array
    {
        return [
            'shop_id'     => $this->shop_id,
            'schedule_id' => $this->schedule_id,
            'user_id'     => $this->user_id,
            'type'        => $this->type,
            'note'        => $this->note,
        ];
    }
}

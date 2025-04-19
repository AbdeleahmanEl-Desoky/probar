<?php

declare(strict_types=1);

namespace Modules\Client\Report\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateReportCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $shop_id,
        private string $schedule_id,
        private string $user_id,
        private ? string $note,
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
            'user_id' => $this->user_id,
            'note' => $this->note,
        ]);
    }
}

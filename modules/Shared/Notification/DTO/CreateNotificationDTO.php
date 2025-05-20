<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateNotificationDTO
{
    public function __construct(
        public string $title,
        public ?string $body,
        public array $data,
        public string $notifiable_id,
        public string $notifiable_type,
    ) {}

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'data' => $this->data,
            'notifiable_id' => $this->notifiable_id,
            'notifiable_type' => $this->notifiable_type,
        ];
    }
}

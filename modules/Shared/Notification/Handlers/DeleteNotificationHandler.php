<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Handlers;

use Modules\Shared\Notification\Repositories\NotificationRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteNotificationHandler
{
    public function __construct(
        private NotificationRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteNotification($id);
    }
}

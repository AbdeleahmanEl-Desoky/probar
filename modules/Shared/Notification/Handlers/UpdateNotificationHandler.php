<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Handlers;

use Modules\Shared\Notification\Commands\UpdateNotificationCommand;
use Modules\Shared\Notification\Repositories\NotificationRepository;

class UpdateNotificationHandler
{
    public function __construct(
        private NotificationRepository $repository,
    ) {
    }

    public function handle(UpdateNotificationCommand $updateNotificationCommand)
    {
        $this->repository->updateNotification($updateNotificationCommand->getId(), $updateNotificationCommand->toArray());
    }
}

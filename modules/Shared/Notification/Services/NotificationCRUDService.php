<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Services;

use Illuminate\Support\Collection;
use Modules\Shared\Notification\DTO\CreateNotificationDTO;
use Modules\Shared\Notification\Models\Notification;
use Modules\Shared\Notification\Repositories\NotificationRepository;
use Ramsey\Uuid\UuidInterface;

class NotificationCRUDService
{
    public function __construct(
        private NotificationRepository $repository,
    ) {
    }

    public function create(CreateNotificationDTO $createNotificationDTO): Notification
    {
         return $this->repository->createNotification($createNotificationDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Notification
    {
        return $this->repository->getNotification(
            id: $id,
        );
    }
}

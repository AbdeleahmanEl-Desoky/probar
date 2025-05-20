<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Shared\Notification\Models\Notification;

/**
 * @property Notification $model
 * @method Notification findOneOrFail($id)
 * @method Notification findOneByOrFail(array $data)
 */
class NotificationRepository extends BaseRepository
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function getNotificationList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getNotification(UuidInterface $id): Notification
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createNotification(array $data): Notification
    {
        return $this->create($data);
    }

    public function updateNotification(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteNotification(UuidInterface $id): bool
    {
        return $this->delete($id);
    }

    public function markAsRead(string $id): bool
    {
        return Notification::where('id', $id)->update(['is_read' => true]);
    }

    public function getByUser(string $userId, string $userType): array
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', $userType)
            ->latest()
            ->get()
            ->toArray();
    }
}

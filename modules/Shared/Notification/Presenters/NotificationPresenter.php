<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Presenters;

use Modules\Shared\Notification\Models\Notification;
use BasePackage\Shared\Presenters\AbstractPresenter;

class NotificationPresenter extends AbstractPresenter
{
    private Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    protected function present(bool $isListing = false): array
    {
        return [
            'id' => $this->notification->id,
            'name' => $this->notification->name,
        ];
    }
}

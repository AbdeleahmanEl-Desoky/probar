<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Shared\Notification\Handlers\DeleteNotificationHandler;
use Modules\Shared\Notification\Handlers\UpdateNotificationHandler;
use Modules\Shared\Notification\Presenters\NotificationPresenter;
use Modules\Shared\Notification\Requests\CreateNotificationRequest;
use Modules\Shared\Notification\Requests\DeleteNotificationRequest;
use Modules\Shared\Notification\Requests\GetNotificationListRequest;
use Modules\Shared\Notification\Requests\GetNotificationRequest;
use Modules\Shared\Notification\Requests\UpdateNotificationRequest;
use Modules\Shared\Notification\Services\NotificationCRUDService;
use Ramsey\Uuid\Uuid;

class NotificationController extends Controller
{
    public function __construct(
        private NotificationCRUDService $notificationService,
        private UpdateNotificationHandler $updateNotificationHandler,
        private DeleteNotificationHandler $deleteNotificationHandler,
    ) {
    }

    public function index(GetNotificationListRequest $request): JsonResponse
    {
        $list = $this->notificationService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(NotificationPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetNotificationRequest $request): JsonResponse
    {
        $item = $this->notificationService->get(Uuid::fromString($request->route('id')));

        $presenter = new NotificationPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateNotificationRequest $request): JsonResponse
    {
        $createdItem = $this->notificationService->create($request->createCreateNotificationDTO());

        $presenter = new NotificationPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateNotificationRequest $request): JsonResponse
    {
        $command = $request->createUpdateNotificationCommand();
        $this->updateNotificationHandler->handle($command);

        $item = $this->notificationService->get($command->getId());

        $presenter = new NotificationPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteNotificationRequest $request): JsonResponse
    {
        $this->deleteNotificationHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

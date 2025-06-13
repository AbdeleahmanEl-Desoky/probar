<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\ScheduleAll\Handlers\DeleteScheduleAllHandler;
use Modules\Admin\ScheduleAll\Handlers\UpdateScheduleAllHandler;
use Modules\Admin\ScheduleAll\Presenters\ScheduleAllPresenter;
use Modules\Admin\ScheduleAll\Requests\CreateScheduleAllRequest;
use Modules\Admin\ScheduleAll\Requests\DeleteScheduleAllRequest;
use Modules\Admin\ScheduleAll\Requests\GetScheduleAllListRequest;
use Modules\Admin\ScheduleAll\Requests\GetScheduleAllRequest;
use Modules\Admin\ScheduleAll\Requests\UpdateScheduleAllRequest;
use Modules\Admin\ScheduleAll\Services\ScheduleAllCRUDService;
use Ramsey\Uuid\Uuid;

class ScheduleAllController extends Controller
{
    public function __construct(
        private ScheduleAllCRUDService $scheduleAllService,
        private UpdateScheduleAllHandler $updateScheduleAllHandler,
        private DeleteScheduleAllHandler $deleteScheduleAllHandler,
    ) {
    }

    public function index(GetScheduleAllListRequest $request): JsonResponse
    {
        $list = $this->scheduleAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ScheduleAllPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetScheduleAllRequest $request): JsonResponse
    {
        $item = $this->scheduleAllService->get(Uuid::fromString($request->route('id')));

        $presenter = new ScheduleAllPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateScheduleAllRequest $request): JsonResponse
    {
        $createdItem = $this->scheduleAllService->create($request->createCreateScheduleAllDTO());

        $presenter = new ScheduleAllPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateScheduleAllRequest $request): JsonResponse
    {
        $command = $request->createUpdateScheduleAllCommand();
        $this->updateScheduleAllHandler->handle($command);

        $item = $this->scheduleAllService->get($command->getId());

        $presenter = new ScheduleAllPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteScheduleAllRequest $request): JsonResponse
    {
        $this->deleteScheduleAllHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Barber\Handlers\DeleteBarberHandler;
use Modules\Admin\Barber\Handlers\UpdateBarberHandler;
use Modules\Admin\Barber\Presenters\BarberPresenter;
use Modules\Admin\Barber\Requests\CreateBarberRequest;
use Modules\Admin\Barber\Requests\DeleteBarberRequest;
use Modules\Admin\Barber\Requests\GetBarberListRequest;
use Modules\Admin\Barber\Requests\GetBarberRequest;
use Modules\Admin\Barber\Requests\UpdateBarberRequest;
use Modules\Admin\Barber\Services\BarberCRUDService;
use Ramsey\Uuid\Uuid;

class BarberController extends Controller
{
    public function __construct(
        private BarberCRUDService $barberService,
        private UpdateBarberHandler $updateBarberHandler,
        private DeleteBarberHandler $deleteBarberHandler,
    ) {
    }

    public function index(GetBarberListRequest $request): JsonResponse
    {
        $list = $this->barberService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(BarberPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetBarberRequest $request): JsonResponse
    {
        $item = $this->barberService->get(Uuid::fromString($request->route('id')));

        $presenter = new BarberPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateBarberRequest $request): JsonResponse
    {
        $createdItem = $this->barberService->create($request->createCreateBarberDTO());

        $presenter = new BarberPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateBarberRequest $request): JsonResponse
    {
        $command = $request->createUpdateBarberCommand();
        $this->updateBarberHandler->handle($command);

        $item = $this->barberService->get($command->getId());

        $presenter = new BarberPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteBarberRequest $request): JsonResponse
    {
        $this->deleteBarberHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

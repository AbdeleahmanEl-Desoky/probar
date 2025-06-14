<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\ShopsHour\Handlers\DeleteShopsHourHandler;
use Modules\Admin\ShopsHour\Handlers\UpdateShopsHourHandler;
use Modules\Admin\ShopsHour\Presenters\ShopsHourPresenter;
use Modules\Admin\ShopsHour\Requests\CreateShopsHourRequest;
use Modules\Admin\ShopsHour\Requests\DeleteShopsHourRequest;
use Modules\Admin\ShopsHour\Requests\GetShopsHourListRequest;
use Modules\Admin\ShopsHour\Requests\GetShopsHourRequest;
use Modules\Admin\ShopsHour\Requests\UpdateShopsHourRequest;
use Modules\Admin\ShopsHour\Services\ShopsHourCRUDService;
use Ramsey\Uuid\Uuid;

class ShopsHourController extends Controller
{
    public function __construct(
        private ShopsHourCRUDService $shopsHourService,
        private UpdateShopsHourHandler $updateShopsHourHandler,
        private DeleteShopsHourHandler $deleteShopsHourHandler,
    ) {
    }

    public function index(GetShopsHourListRequest $request)
    {
        $list = $this->shopsHourService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        $list->setCollection(collect(ShopsHourPresenter::collection($list->items())));

        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('shops-hour::index', [
            'shops' => $list,
            'pagination' => $pagination,
        ]);
    }

    public function show(GetShopsHourRequest $request): JsonResponse
    {
        $item = $this->shopsHourService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopsHourPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopsHourRequest $request): JsonResponse
    {
        $createdItem = $this->shopsHourService->create($request->createCreateShopsHourDTO());

        $presenter = new ShopsHourPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopsHourRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopsHourCommand();
        $this->updateShopsHourHandler->handle($command);

        $item = $this->shopsHourService->get($command->getId());

        $presenter = new ShopsHourPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopsHourRequest $request): JsonResponse
    {
        $this->deleteShopsHourHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

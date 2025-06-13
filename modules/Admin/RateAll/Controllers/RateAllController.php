<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\RateAll\Handlers\DeleteRateAllHandler;
use Modules\Admin\RateAll\Handlers\UpdateRateAllHandler;
use Modules\Admin\RateAll\Presenters\RateAllPresenter;
use Modules\Admin\RateAll\Requests\CreateRateAllRequest;
use Modules\Admin\RateAll\Requests\DeleteRateAllRequest;
use Modules\Admin\RateAll\Requests\GetRateAllListRequest;
use Modules\Admin\RateAll\Requests\GetRateAllRequest;
use Modules\Admin\RateAll\Requests\UpdateRateAllRequest;
use Modules\Admin\RateAll\Services\RateAllCRUDService;
use Ramsey\Uuid\Uuid;

class RateAllController extends Controller
{
    public function __construct(
        private RateAllCRUDService $rateAllService,
        private UpdateRateAllHandler $updateRateAllHandler,
        private DeleteRateAllHandler $deleteRateAllHandler,
    ) {
    }

    public function index(GetRateAllListRequest $request): JsonResponse
    {
        $list = $this->rateAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(RateAllPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetRateAllRequest $request): JsonResponse
    {
        $item = $this->rateAllService->get(Uuid::fromString($request->route('id')));

        $presenter = new RateAllPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateRateAllRequest $request): JsonResponse
    {
        $createdItem = $this->rateAllService->create($request->createCreateRateAllDTO());

        $presenter = new RateAllPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateRateAllRequest $request): JsonResponse
    {
        $command = $request->createUpdateRateAllCommand();
        $this->updateRateAllHandler->handle($command);

        $item = $this->rateAllService->get($command->getId());

        $presenter = new RateAllPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteRateAllRequest $request): JsonResponse
    {
        $this->deleteRateAllHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

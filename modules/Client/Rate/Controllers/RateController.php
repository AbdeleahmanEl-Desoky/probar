<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Client\Rate\Handlers\DeleteRateHandler;
use Modules\Client\Rate\Handlers\UpdateRateHandler;
use Modules\Client\Rate\Presenters\RatePresenter;
use Modules\Client\Rate\Requests\CreateRateRequest;
use Modules\Client\Rate\Requests\DeleteRateRequest;
use Modules\Client\Rate\Requests\GetRateListRequest;
use Modules\Client\Rate\Requests\GetRateRequest;
use Modules\Client\Rate\Requests\UpdateRateRequest;
use Modules\Client\Rate\Services\RateCRUDService;
use Ramsey\Uuid\Uuid;

class RateController extends Controller
{
    public function __construct(
        private RateCRUDService $rateService,
        private UpdateRateHandler $updateRateHandler,
        private DeleteRateHandler $deleteRateHandler,
    ) {
    }

    public function index(GetRateListRequest $request): JsonResponse
    {
        $list = $this->rateService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(RatePresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetRateRequest $request): JsonResponse
    {
        $item = $this->rateService->get(Uuid::fromString($request->route('id')));

        $presenter = new RatePresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateRateRequest $request): JsonResponse
    {
        $createCreateRateDTO = $request->createCreateRateDTO();
        $createCreateRateDTO->client_id =  auth('api_clients')->user()->id;

        $createdItem = $this->rateService->create($createCreateRateDTO);

        $presenter = new RatePresenter($createdItem);
        return Json::item($presenter->getData());
    }

    public function update(UpdateRateRequest $request): JsonResponse
    {
        $command = $request->createUpdateRateCommand();
        $this->updateRateHandler->handle($command);

        $item = $this->rateService->get($command->getId());

        $presenter = new RatePresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteRateRequest $request): JsonResponse
    {
        $this->deleteRateHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

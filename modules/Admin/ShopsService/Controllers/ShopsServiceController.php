<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\ShopsService\Handlers\DeleteShopsServiceHandler;
use Modules\Admin\ShopsService\Handlers\UpdateShopsServiceHandler;
use Modules\Admin\ShopsService\Presenters\ShopsServicePresenter;
use Modules\Admin\ShopsService\Requests\CreateShopsServiceRequest;
use Modules\Admin\ShopsService\Requests\DeleteShopsServiceRequest;
use Modules\Admin\ShopsService\Requests\GetShopsServiceListRequest;
use Modules\Admin\ShopsService\Requests\GetShopsServiceRequest;
use Modules\Admin\ShopsService\Requests\UpdateShopsServiceRequest;
use Modules\Admin\ShopsService\Services\ShopsServiceCRUDService;
use Ramsey\Uuid\Uuid;

class ShopsServiceController extends Controller
{
    public function __construct(
        private ShopsServiceCRUDService $shopsServiceService,
        private UpdateShopsServiceHandler $updateShopsServiceHandler,
        private DeleteShopsServiceHandler $deleteShopsServiceHandler,
    ) {
    }

    public function index(GetShopsServiceListRequest $request): JsonResponse
    {
        $list = $this->shopsServiceService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ShopsServicePresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetShopsServiceRequest $request): JsonResponse
    {
        $item = $this->shopsServiceService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopsServicePresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopsServiceRequest $request): JsonResponse
    {
        $createdItem = $this->shopsServiceService->create($request->createCreateShopsServiceDTO());

        $presenter = new ShopsServicePresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopsServiceRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopsServiceCommand();
        $this->updateShopsServiceHandler->handle($command);

        $item = $this->shopsServiceService->get($command->getId());

        $presenter = new ShopsServicePresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopsServiceRequest $request): JsonResponse
    {
        $this->deleteShopsServiceHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

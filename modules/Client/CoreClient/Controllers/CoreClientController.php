<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Client\CoreClient\Handlers\DeleteCoreClientHandler;
use Modules\Client\CoreClient\Handlers\UpdateCoreClientHandler;
use Modules\Client\CoreClient\Presenters\CoreClientPresenter;
use Modules\Client\CoreClient\Requests\CreateCoreClientRequest;
use Modules\Client\CoreClient\Requests\DeleteCoreClientRequest;
use Modules\Client\CoreClient\Requests\GetCoreClientListRequest;
use Modules\Client\CoreClient\Requests\GetCoreClientRequest;
use Modules\Client\CoreClient\Requests\UpdateCoreClientRequest;
use Modules\Client\CoreClient\Services\CoreClientCRUDService;
use Ramsey\Uuid\Uuid;

class CoreClientController extends Controller
{
    public function __construct(
        private CoreClientCRUDService $coreClientService,
        private UpdateCoreClientHandler $updateCoreClientHandler,
        private DeleteCoreClientHandler $deleteCoreClientHandler,
    ) {
    }

    public function index(GetCoreClientListRequest $request): JsonResponse
    {
        $list = $this->coreClientService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::buildItems(null,['core_clients' => CoreClientPresenter::collection($list['data']),'pagination' => $list['pagination']]);
    }

    public function show(GetCoreClientRequest $request): JsonResponse
    {
        $item = $this->coreClientService->get(Uuid::fromString($request->route('id')));

        $presenter = new CoreClientPresenter($item);

        return Json::buildItems('core_client', $presenter->getData());
    }

    public function store(CreateCoreClientRequest $request): JsonResponse
    {
        $createdItem = $this->coreClientService->create($request->createCreateCoreClientDTO());

        $presenter = new CoreClientPresenter($createdItem);

        return Json::buildItems('core_client', $presenter->getData());
    }

    public function update(UpdateCoreClientRequest $request): JsonResponse
    {
        $command = $request->createUpdateCoreClientCommand();
        $this->updateCoreClientHandler->handle($command);

        $item = $this->coreClientService->get($command->getId());

        $presenter = new CoreClientPresenter($item);

        return Json::buildItems('core_client', $presenter->getData());
    }

    public function delete(DeleteCoreClientRequest $request): JsonResponse
    {
        $this->deleteCoreClientHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

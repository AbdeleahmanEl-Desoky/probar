<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Client\Handlers\DeleteClientHandler;
use Modules\Admin\Client\Handlers\UpdateClientHandler;
use Modules\Admin\Client\Presenters\ClientPresenter;
use Modules\Admin\Client\Requests\CreateClientRequest;
use Modules\Admin\Client\Requests\DeleteClientRequest;
use Modules\Admin\Client\Requests\GetClientListRequest;
use Modules\Admin\Client\Requests\GetClientRequest;
use Modules\Admin\Client\Requests\UpdateClientRequest;
use Modules\Admin\Client\Services\ClientCRUDService;
use Ramsey\Uuid\Uuid;

class ClientController extends Controller
{
    public function __construct(
        private ClientCRUDService $clientService,
        private UpdateClientHandler $updateClientHandler,
        private DeleteClientHandler $deleteClientHandler,
    ) {
    }

    public function index(GetClientListRequest $request): JsonResponse
    {
        $list = $this->clientService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ClientPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetClientRequest $request): JsonResponse
    {
        $item = $this->clientService->get(Uuid::fromString($request->route('id')));

        $presenter = new ClientPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateClientRequest $request): JsonResponse
    {
        $createdItem = $this->clientService->create($request->createCreateClientDTO());

        $presenter = new ClientPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateClientRequest $request): JsonResponse
    {
        $command = $request->createUpdateClientCommand();
        $this->updateClientHandler->handle($command);

        $item = $this->clientService->get($command->getId());

        $presenter = new ClientPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteClientRequest $request): JsonResponse
    {
        $this->deleteClientHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

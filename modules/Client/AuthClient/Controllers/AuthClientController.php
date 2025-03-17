<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Client\AuthClient\Handlers\DeleteAuthClientHandler;
use Modules\Client\AuthClient\Handlers\UpdateAuthClientHandler;
use Modules\Client\AuthClient\Presenters\AuthClientPresenter;
use Modules\Client\AuthClient\Requests\CreateAuthClientRequest;
use Modules\Client\AuthClient\Requests\DeleteAuthClientRequest;
use Modules\Client\AuthClient\Requests\GetAuthClientListRequest;
use Modules\Client\AuthClient\Requests\GetAuthClientRequest;
use Modules\Client\AuthClient\Requests\UpdateAuthClientRequest;
use Modules\Client\AuthClient\Services\AuthClientCRUDService;
use Ramsey\Uuid\Uuid;

class AuthClientController extends Controller
{
    public function __construct(
        private AuthClientCRUDService $authClientService,
        private UpdateAuthClientHandler $updateAuthClientHandler,
        private DeleteAuthClientHandler $deleteAuthClientHandler,
    ) {
    }

    public function index(GetAuthClientListRequest $request): JsonResponse
    {
        $list = $this->authClientService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::buildItems(null,['auth_clients' => AuthClientPresenter::collection($list['data']),'pagination' => $list['pagination']]);
    }

    public function show(GetAuthClientRequest $request): JsonResponse
    {
        $item = $this->authClientService->get(Uuid::fromString($request->route('id')));

        $presenter = new AuthClientPresenter($item);

        return Json::buildItems('auth_client', $presenter->getData());
    }

    public function store(CreateAuthClientRequest $request): JsonResponse
    {
        $createdItem = $this->authClientService->create($request->createCreateAuthClientDTO());

        $presenter = new AuthClientPresenter($createdItem);

        return Json::buildItems('auth_client', $presenter->getData());
    }

    public function update(UpdateAuthClientRequest $request): JsonResponse
    {
        $command = $request->createUpdateAuthClientCommand();
        $this->updateAuthClientHandler->handle($command);

        $item = $this->authClientService->get($command->getId());

        $presenter = new AuthClientPresenter($item);

        return Json::buildItems('auth_client', $presenter->getData());
    }

    public function delete(DeleteAuthClientRequest $request): JsonResponse
    {
        $this->deleteAuthClientHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

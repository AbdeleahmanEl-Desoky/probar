<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\AuthAdmin\Handlers\DeleteAuthAdminHandler;
use Modules\Admin\AuthAdmin\Handlers\UpdateAuthAdminHandler;
use Modules\Admin\AuthAdmin\Presenters\AuthAdminPresenter;
use Modules\Admin\AuthAdmin\Requests\CreateAuthAdminRequest;
use Modules\Admin\AuthAdmin\Requests\DeleteAuthAdminRequest;
use Modules\Admin\AuthAdmin\Requests\GetAuthAdminListRequest;
use Modules\Admin\AuthAdmin\Requests\GetAuthAdminRequest;
use Modules\Admin\AuthAdmin\Requests\UpdateAuthAdminRequest;
use Modules\Admin\AuthAdmin\Services\AuthAdminCRUDService;
use Ramsey\Uuid\Uuid;

class AuthAdminController extends Controller
{
    public function __construct(
        private AuthAdminCRUDService $authAdminService,
        private UpdateAuthAdminHandler $updateAuthAdminHandler,
        private DeleteAuthAdminHandler $deleteAuthAdminHandler,
    ) {
    }

    public function index(GetAuthAdminListRequest $request): JsonResponse
    {
        $list = $this->authAdminService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::buildItems(null,['auth_admins' => AuthAdminPresenter::collection($list['data']),'pagination' => $list['pagination']]);
    }

    public function show(GetAuthAdminRequest $request): JsonResponse
    {
        $item = $this->authAdminService->get(Uuid::fromString($request->route('id')));

        $presenter = new AuthAdminPresenter($item);

        return Json::buildItems('auth_admin', $presenter->getData());
    }

    public function store(CreateAuthAdminRequest $request): JsonResponse
    {
        $createdItem = $this->authAdminService->create($request->createCreateAuthAdminDTO());

        $presenter = new AuthAdminPresenter($createdItem);

        return Json::buildItems('auth_admin', $presenter->getData());
    }

    public function update(UpdateAuthAdminRequest $request): JsonResponse
    {
        $command = $request->createUpdateAuthAdminCommand();
        $this->updateAuthAdminHandler->handle($command);

        $item = $this->authAdminService->get($command->getId());

        $presenter = new AuthAdminPresenter($item);

        return Json::buildItems('auth_admin', $presenter->getData());
    }

    public function delete(DeleteAuthAdminRequest $request): JsonResponse
    {
        $this->deleteAuthAdminHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Modules\Admin\CoreAdmin\Handlers\DeleteCoreAdminHandler;
use Modules\Admin\CoreAdmin\Handlers\UpdateCoreAdminHandler;
use Modules\Admin\CoreAdmin\Presenters\CoreAdminPresenter;
use Modules\Admin\CoreAdmin\Requests\CreateCoreAdminRequest;
use Modules\Admin\CoreAdmin\Requests\DeleteCoreAdminRequest;
use Modules\Admin\CoreAdmin\Requests\GetCoreAdminListRequest;
use Modules\Admin\CoreAdmin\Requests\GetCoreAdminRequest;
use Modules\Admin\CoreAdmin\Requests\UpdateCoreAdminRequest;
use Modules\Admin\CoreAdmin\Services\CoreAdminCRUDService;
use Ramsey\Uuid\Uuid;

class CoreAdminController extends Controller
{
    public function __construct(
        private CoreAdminCRUDService $coreAdminService,
        private UpdateCoreAdminHandler $updateCoreAdminHandler,
        private DeleteCoreAdminHandler $deleteCoreAdminHandler,
    ) {
    }

    public function index(GetCoreAdminListRequest $request): View
    {
        return view('admin::dashboard.welcome', [
            'title' => 'Core Admins',
            'description' => 'Manage core administrators of the system.',
        ]);
    }

    public function show(GetCoreAdminRequest $request): JsonResponse
    {
        $item = $this->coreAdminService->get(Uuid::fromString($request->route('id')));

        $presenter = new CoreAdminPresenter($item);

        return Json::buildItems('core_admin', $presenter->getData());
    }

    public function store(CreateCoreAdminRequest $request): JsonResponse
    {
        $createdItem = $this->coreAdminService->create($request->createCreateCoreAdminDTO());

        $presenter = new CoreAdminPresenter($createdItem);

        return Json::buildItems('core_admin', $presenter->getData());
    }

    public function update(UpdateCoreAdminRequest $request): JsonResponse
    {
        $command = $request->createUpdateCoreAdminCommand();
        $this->updateCoreAdminHandler->handle($command);

        $item = $this->coreAdminService->get($command->getId());

        $presenter = new CoreAdminPresenter($item);

        return Json::buildItems('core_admin', $presenter->getData());
    }

    public function delete(DeleteCoreAdminRequest $request): JsonResponse
    {
        $this->deleteCoreAdminHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

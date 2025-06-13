<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\HelpAll\Handlers\DeleteHelpAllHandler;
use Modules\Admin\HelpAll\Handlers\UpdateHelpAllHandler;
use Modules\Admin\HelpAll\Presenters\HelpAllPresenter;
use Modules\Admin\HelpAll\Requests\CreateHelpAllRequest;
use Modules\Admin\HelpAll\Requests\DeleteHelpAllRequest;
use Modules\Admin\HelpAll\Requests\GetHelpAllListRequest;
use Modules\Admin\HelpAll\Requests\GetHelpAllRequest;
use Modules\Admin\HelpAll\Requests\UpdateHelpAllRequest;
use Modules\Admin\HelpAll\Services\HelpAllCRUDService;
use Ramsey\Uuid\Uuid;

class HelpAllController extends Controller
{
    public function __construct(
        private HelpAllCRUDService $helpAllService,
        private UpdateHelpAllHandler $updateHelpAllHandler,
        private DeleteHelpAllHandler $deleteHelpAllHandler,
    ) {
    }

    public function index(GetHelpAllListRequest $request): JsonResponse
    {
        $list = $this->helpAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(HelpAllPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetHelpAllRequest $request): JsonResponse
    {
        $item = $this->helpAllService->get(Uuid::fromString($request->route('id')));

        $presenter = new HelpAllPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateHelpAllRequest $request): JsonResponse
    {
        $createdItem = $this->helpAllService->create($request->createCreateHelpAllDTO());

        $presenter = new HelpAllPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateHelpAllRequest $request): JsonResponse
    {
        $command = $request->createUpdateHelpAllCommand();
        $this->updateHelpAllHandler->handle($command);

        $item = $this->helpAllService->get($command->getId());

        $presenter = new HelpAllPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteHelpAllRequest $request): JsonResponse
    {
        $this->deleteHelpAllHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

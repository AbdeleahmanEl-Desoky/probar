<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Shared\Help\Handlers\DeleteHelpHandler;
use Modules\Shared\Help\Handlers\UpdateHelpHandler;
use Modules\Shared\Help\Presenters\HelpPresenter;
use Modules\Shared\Help\Requests\CreateHelpRequest;
use Modules\Shared\Help\Requests\DeleteHelpRequest;
use Modules\Shared\Help\Requests\GetHelpListRequest;
use Modules\Shared\Help\Requests\GetHelpRequest;
use Modules\Shared\Help\Requests\UpdateHelpRequest;
use Modules\Shared\Help\Services\HelpCRUDService;
use Ramsey\Uuid\Uuid;

class HelpController extends Controller
{
    public function __construct(
        private HelpCRUDService $helpService,
        private UpdateHelpHandler $updateHelpHandler,
        private DeleteHelpHandler $deleteHelpHandler,
    ) {
    }

    public function index(GetHelpListRequest $request): JsonResponse
    {
        $list = $this->helpService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(HelpPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetHelpRequest $request): JsonResponse
    {
        $item = $this->helpService->get(Uuid::fromString($request->route('id')));

        $presenter = new HelpPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateHelpRequest $request): JsonResponse
    {
        $createdItem = $this->helpService->create($request->createCreateHelpDTO());

        $presenter = new HelpPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateHelpRequest $request): JsonResponse
    {
        $command = $request->createUpdateHelpCommand();
        $this->updateHelpHandler->handle($command);

        $item = $this->helpService->get($command->getId());

        $presenter = new HelpPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteHelpRequest $request): JsonResponse
    {
        $this->deleteHelpHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

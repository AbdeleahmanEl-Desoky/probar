<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\FavoriteClient\Handlers\DeleteFavoriteClientHandler;
use Modules\Admin\FavoriteClient\Handlers\UpdateFavoriteClientHandler;
use Modules\Admin\FavoriteClient\Presenters\FavoriteClientPresenter;
use Modules\Admin\FavoriteClient\Requests\CreateFavoriteClientRequest;
use Modules\Admin\FavoriteClient\Requests\DeleteFavoriteClientRequest;
use Modules\Admin\FavoriteClient\Requests\GetFavoriteClientListRequest;
use Modules\Admin\FavoriteClient\Requests\GetFavoriteClientRequest;
use Modules\Admin\FavoriteClient\Requests\UpdateFavoriteClientRequest;
use Modules\Admin\FavoriteClient\Services\FavoriteClientCRUDService;
use Ramsey\Uuid\Uuid;

class FavoriteClientController extends Controller
{
    public function __construct(
        private FavoriteClientCRUDService $favoriteClientService,
        private UpdateFavoriteClientHandler $updateFavoriteClientHandler,
        private DeleteFavoriteClientHandler $deleteFavoriteClientHandler,
    ) {
    }

    public function index(GetFavoriteClientListRequest $request): JsonResponse
    {
        $list = $this->favoriteClientService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(FavoriteClientPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetFavoriteClientRequest $request): JsonResponse
    {
        $item = $this->favoriteClientService->get(Uuid::fromString($request->route('id')));

        $presenter = new FavoriteClientPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateFavoriteClientRequest $request): JsonResponse
    {
        $createdItem = $this->favoriteClientService->create($request->createCreateFavoriteClientDTO());

        $presenter = new FavoriteClientPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateFavoriteClientRequest $request): JsonResponse
    {
        $command = $request->createUpdateFavoriteClientCommand();
        $this->updateFavoriteClientHandler->handle($command);

        $item = $this->favoriteClientService->get($command->getId());

        $presenter = new FavoriteClientPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteFavoriteClientRequest $request): JsonResponse
    {
        $this->deleteFavoriteClientHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

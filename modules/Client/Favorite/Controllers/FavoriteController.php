<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Client\Favorite\Handlers\DeleteFavoriteHandler;
use Modules\Client\Favorite\Handlers\UpdateFavoriteHandler;
use Modules\Client\Favorite\Presenters\FavoritePresenter;
use Modules\Client\Favorite\Requests\CreateFavoriteRequest;
use Modules\Client\Favorite\Requests\DeleteFavoriteRequest;
use Modules\Client\Favorite\Requests\GetFavoriteListRequest;
use Modules\Client\Favorite\Requests\GetFavoriteRequest;
use Modules\Client\Favorite\Requests\UpdateFavoriteRequest;
use Modules\Client\Favorite\Services\FavoriteCRUDService;
use Ramsey\Uuid\Uuid;

class FavoriteController extends Controller
{
    public function __construct(
        private FavoriteCRUDService $favoriteService,
        private UpdateFavoriteHandler $updateFavoriteHandler,
        private DeleteFavoriteHandler $deleteFavoriteHandler,
    ) {
    }

    public function index(GetFavoriteListRequest $request): JsonResponse
    {
        $list = $this->favoriteService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(FavoritePresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetFavoriteRequest $request): JsonResponse
    {
        $item = $this->favoriteService->get(Uuid::fromString($request->route('id')));

        $presenter = new FavoritePresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateFavoriteRequest $request): JsonResponse
    {
        $createdItem = $this->favoriteService->create($request->createCreateFavoriteDTO());

        $presenter = new FavoritePresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateFavoriteRequest $request): JsonResponse
    {
        $command = $request->createUpdateFavoriteCommand();
        $this->updateFavoriteHandler->handle($command);

        $item = $this->favoriteService->get($command->getId());

        $presenter = new FavoritePresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteFavoriteRequest $request): JsonResponse
    {
        $this->deleteFavoriteHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

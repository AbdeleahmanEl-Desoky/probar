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


    public function index(GetFavoriteClientListRequest $request)
    {
        $list = $this->favoriteClientService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        $list->setCollection(collect(FavoriteClientPresenter::collection($list->items())));

        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('favorite::index', [
            'favorites' => $list,
            'pagination' => $pagination,
        ]);
    }


}

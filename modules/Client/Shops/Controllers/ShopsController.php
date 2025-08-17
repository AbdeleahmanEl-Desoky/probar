<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Presenters\ShopDetailsPresenter;
use Modules\Client\Shops\Presenters\ShopDetailsPresenter as PresentersShopDetailsPresenter;
use Modules\Client\Shops\Presenters\ShopsPresenter;
use Modules\Client\Shops\Requests\GetShopsListRequest;
use Modules\Client\Shops\Requests\GetShopsRequest;
use Modules\Client\Shops\Services\ShopsCRUDService;
use Ramsey\Uuid\Uuid;

class ShopsController extends Controller
{
    public function __construct(
        private ShopsCRUDService $shopsService,
    ) {
    }

    public function index(GetShopsListRequest $request): JsonResponse
    {
        $list = $this->shopsService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ShopsPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetShopsRequest $request): JsonResponse
    {
        $item = $this->shopsService->get(Uuid::fromString($request->route('id')));

        $presenter = new PresentersShopDetailsPresenter($item);

        return Json::item($presenter->getData());
    }


}

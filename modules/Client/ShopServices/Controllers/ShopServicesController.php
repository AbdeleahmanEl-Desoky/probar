<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Client\ShopServices\Presenters\ShopServicesPresenter;
use Modules\Client\ShopServices\Requests\GetShopServicesListRequest;
use Modules\Client\ShopServices\Services\ShopServicesCRUDService;
use Ramsey\Uuid\Uuid;

class ShopServicesController extends Controller
{
    public function __construct(
        private ShopServicesCRUDService $shopServicesService,

    ) {
    }

    public function index(GetShopServicesListRequest $request): JsonResponse
    {
        $list = $this->shopServicesService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10),
            Uuid::fromString($request->route('shop_id'))
        );

        return Json::items(ShopServicesPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }
    public function indexAll(GetShopServicesListRequest $request): JsonResponse
    {
        $list = $this->shopServicesService->listAll();

        return Json::items(ShopServicesPresenter::collection($list));
    }


}

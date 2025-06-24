<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\ShopBarber\Handlers\DeleteShopBarberHandler;
use Modules\Admin\ShopBarber\Handlers\UpdateShopBarberHandler;
use Modules\Admin\ShopBarber\Presenters\ShopBarberPresenter;
use Modules\Admin\ShopBarber\Requests\CreateShopBarberRequest;
use Modules\Admin\ShopBarber\Requests\DeleteShopBarberRequest;
use Modules\Admin\ShopBarber\Requests\GetShopBarberListRequest;
use Modules\Admin\ShopBarber\Requests\GetShopBarberRequest;
use Modules\Admin\ShopBarber\Requests\UpdateShopBarberRequest;
use Modules\Admin\ShopBarber\Services\ShopBarberCRUDService;
use Modules\Barber\Shop\Models\Shop;
use Ramsey\Uuid\Uuid;

class ShopBarberController extends Controller
{
    public function __construct(
        private ShopBarberCRUDService $shopBarberService,
        private UpdateShopBarberHandler $updateShopBarberHandler,
        private DeleteShopBarberHandler $deleteShopBarberHandler,
    ) {
    }

    public function index(GetShopBarberListRequest $request)
    {
        $list = $this->shopBarberService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        $list->setCollection(collect(ShopBarberPresenter::collection($list->items())));

        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('shop::index', [
            'shops' => $list,
            'pagination' => $pagination,
        ]);
    }
        public function toggleFeatured(string $id): JsonResponse
        {
            $shop = Shop::findOrFail($id);
            $shop->featured = !$shop->featured;
            $shop->save();

            return response()->json([
                'message' => 'Featured status updated',
                'featured' => $shop->featured,
            ]);
        }
}

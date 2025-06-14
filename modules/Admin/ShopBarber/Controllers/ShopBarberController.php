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

    public function show(GetShopBarberRequest $request): JsonResponse
    {
        $item = $this->shopBarberService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopBarberPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopBarberRequest $request): JsonResponse
    {
        $createdItem = $this->shopBarberService->create($request->createCreateShopBarberDTO());

        $presenter = new ShopBarberPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopBarberRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopBarberCommand();
        $this->updateShopBarberHandler->handle($command);

        $item = $this->shopBarberService->get($command->getId());

        $presenter = new ShopBarberPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopBarberRequest $request): JsonResponse
    {
        $this->deleteShopBarberHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Controllers;

use BasePackage\Shared\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Handlers\DeleteShopHandler;
use Modules\Barber\Shop\Handlers\UpdateShopHandler;
use Modules\Barber\Shop\Presenters\ShopPresenter;
use Modules\Barber\Shop\Requests\CreateShopRequest;
use Modules\Barber\Shop\Requests\DeleteShopRequest;
use Modules\Barber\Shop\Requests\GetShopListRequest;
use Modules\Barber\Shop\Requests\GetShopRequest;
use Modules\Barber\Shop\Requests\UpdateShopRequest;
use Modules\Barber\Shop\Services\ShopCRUDService;
use Ramsey\Uuid\Uuid;

class ShopController extends Controller
{
    public function __construct(
        private ShopCRUDService $shopService,
        private UpdateShopHandler $updateShopHandler,
        private DeleteShopHandler $deleteShopHandler,
    ) {
    }

    public function index(GetShopListRequest $request): JsonResponse
    {
        $list = $this->shopService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ShopPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetShopRequest $request): JsonResponse
    {
        $item = $this->shopService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopRequest $request): JsonResponse
    {
        $createdItem = $this->shopService->create($request->createCreateShopDTO());

        $presenter = new ShopPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopCommand();
        $this->updateShopHandler->handle($command);

        $item = $this->shopService->get($command->getId());

        $presenter = new ShopPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopRequest $request): JsonResponse
    {
        $this->deleteShopHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

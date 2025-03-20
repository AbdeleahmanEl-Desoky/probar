<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\ShopService\Handlers\DeleteShopServiceHandler;
use Modules\Barber\ShopService\Handlers\UpdateShopServiceHandler;
use Modules\Barber\ShopService\Presenters\ShopServicePresenter;
use Modules\Barber\ShopService\Requests\CreateShopServiceRequest;
use Modules\Barber\ShopService\Requests\DeleteShopServiceRequest;
use Modules\Barber\ShopService\Requests\GetShopServiceListRequest;
use Modules\Barber\ShopService\Requests\GetShopServiceRequest;
use Modules\Barber\ShopService\Requests\UpdateShopServiceRequest;
use Modules\Barber\ShopService\Services\ShopServiceCRUDService;
use Ramsey\Uuid\Uuid;

class ShopServiceController extends Controller
{
    public function __construct(
        private ShopServiceCRUDService $shopServiceService,
        private UpdateShopServiceHandler $updateShopServiceHandler,
        private DeleteShopServiceHandler $deleteShopServiceHandler,
    ) {
    }

    public function index(GetShopServiceListRequest $request): JsonResponse
    {
        $list = $this->shopServiceService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ShopServicePresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetShopServiceRequest $request): JsonResponse
    {
        $item = $this->shopServiceService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopServicePresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopServiceRequest $request): JsonResponse
    {
        $createdItem = $this->shopServiceService->create($request->createCreateShopServiceDTO());

        $presenter = new ShopServicePresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateShopServiceRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopServiceCommand();
        $this->updateShopServiceHandler->handle($command);

        $item = $this->shopServiceService->get($command->getId());

        $presenter = new ShopServicePresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopServiceRequest $request): JsonResponse
    {
        $this->deleteShopServiceHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

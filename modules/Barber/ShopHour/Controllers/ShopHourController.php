<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Modules\Barber\ShopHour\Handlers\DeleteShopHourHandler;
use Modules\Barber\ShopHour\Handlers\UpdateShopHourHandler;
use Modules\Barber\ShopHour\Presenters\ShopHourPresenter;
use Modules\Barber\ShopHour\Presenters\ShopHourshowPresenter;
use Modules\Barber\ShopHour\Requests\CreateShopHourRequest;
use Modules\Barber\ShopHour\Requests\DeleteShopHourRequest;
use Modules\Barber\ShopHour\Requests\GetShopHourListRequest;
use Modules\Barber\ShopHour\Requests\GetShopHourRequest;
use Modules\Barber\ShopHour\Requests\UpdateShopHourRequest;
use Modules\Barber\ShopHour\Services\ShopHourCRUDService;
use Ramsey\Uuid\Uuid;

class ShopHourController extends Controller
{
    public function __construct(
        private ShopHourCRUDService $shopHourService,
        private UpdateShopHourHandler $updateShopHourHandler,
        private DeleteShopHourHandler $deleteShopHourHandler,
        private ShopRepository $shopRepository,

    ) {
    }

    public function index(GetShopHourListRequest $request)//: JsonResponse
    {
        $userId = auth()->user()->id;
        $barberId = Uuid::fromString($userId);

       $shop = $this->shopRepository->getMyShop($barberId);

        $list = $this->shopHourService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10),
            Uuid::fromString($shop->id),
        );
        
        return Json::items(ShopHourPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetShopHourRequest $request): JsonResponse
    {
        $item = $this->shopHourService->get(Uuid::fromString($request->route('id')));

        $presenter = new ShopHourshowPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateShopHourRequest $request)//: JsonResponse
    {
        $createdItem = $this->shopHourService->create($request->createCreateShopHourDTO());

        return Json::done("");
    }

    public function update(UpdateShopHourRequest $request): JsonResponse
    {
        $command = $request->createUpdateShopHourCommand();
        $this->updateShopHourHandler->handle($command);

        $item = $this->shopHourService->get($command->getId());

        $presenter = new ShopHourPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteShopHourRequest $request): JsonResponse
    {
        $this->deleteShopHourHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

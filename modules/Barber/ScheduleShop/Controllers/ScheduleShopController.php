<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Modules\Barber\ScheduleShop\Handlers\DeleteScheduleShopHandler;
use Modules\Barber\ScheduleShop\Handlers\UpdateScheduleShopHandler;
use Modules\Barber\ScheduleShop\Presenters\ScheduleShopPresenter;
use Modules\Barber\ScheduleShop\Requests\CreateScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\DeleteScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\GetScheduleShopListRequest;
use Modules\Barber\ScheduleShop\Requests\GetScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\UpdateScheduleShopRequest;
use Modules\Barber\ScheduleShop\Services\ScheduleShopCRUDService;
use Ramsey\Uuid\Uuid;

class ScheduleShopController extends Controller
{
    public function __construct(
        private ScheduleShopCRUDService $scheduleShopService,
        private UpdateScheduleShopHandler $updateScheduleShopHandler,
        private DeleteScheduleShopHandler $deleteScheduleShopHandler,
        private ShopRepository $shopRepository,
    ) {
    }

    public function mostSellingServices(GetScheduleShopListRequest $request)//: JsonResponse
    {
        $userId = auth()->user()->id;
        $barberId = Uuid::fromString($userId);

        $shop = $this->shopRepository->getMyShop($barberId);

        $scheduleShopService = $this->scheduleShopService->mostSellingServices(
            shopId: $shop->id,
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date'),
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 10)

        );

        return Json::items($scheduleShopService);
    }
    public function rate(GetScheduleShopListRequest $request)//: JsonResponse
    {
        $userId = auth()->user()->id;
        $barberId = Uuid::fromString($userId);

        $shop = $this->shopRepository->getMyShop($barberId);

        $scheduleShopService = $this->scheduleShopService->rate(
            shopId: $shop->id,
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date'),
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 10)

        );

        return Json::items($scheduleShopService);
    }

    public function totalEarning(GetScheduleShopListRequest $request)//: JsonResponse
    {
        $userId = auth()->user()->id;
        $barberId = Uuid::fromString($userId);

        $shop = $this->shopRepository->getMyShop($barberId);

        $scheduleShopService = $this->scheduleShopService->totalEarning(
            shopId: $shop->id,
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date')
        );

        return Json::items($scheduleShopService);
    }

    public function show(GetScheduleShopRequest $request): JsonResponse
    {
        $item = $this->scheduleShopService->get(Uuid::fromString($request->route('id')));

        $presenter = new ScheduleShopPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateScheduleShopRequest $request): JsonResponse
    {
        $createdItem = $this->scheduleShopService->create($request->createCreateScheduleShopDTO());

        $presenter = new ScheduleShopPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateScheduleShopRequest $request): JsonResponse
    {
        $command = $request->createUpdateScheduleShopCommand();
        $this->updateScheduleShopHandler->handle($command);

        $item = $this->scheduleShopService->get($command->getId());

        $presenter = new ScheduleShopPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteScheduleShopRequest $request): JsonResponse
    {
        $this->deleteScheduleShopHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

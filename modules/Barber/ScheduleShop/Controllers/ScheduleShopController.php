<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Modules\Barber\ScheduleShop\Handlers\DeleteScheduleShopHandler;
use Modules\Barber\ScheduleShop\Handlers\UpdateScheduleShopHandler;
use Modules\Barber\ScheduleShop\Handlers\UpdateScheduleShopPaymentHandler;
use Modules\Barber\ScheduleShop\Handlers\UpdateScheduleShopStatusHandler;
use Modules\Barber\ScheduleShop\Presenters\ScheduleShopPresenter;
use Modules\Barber\ScheduleShop\Requests\CreateScheduleRequest;
use Modules\Barber\ScheduleShop\Requests\CreateScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\DeleteScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\GetScheduleShopListRequest;
use Modules\Barber\ScheduleShop\Requests\GetScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\UpdateScheduleShopPaymentRequest;
use Modules\Barber\ScheduleShop\Requests\UpdateScheduleShopRequest;
use Modules\Barber\ScheduleShop\Requests\UpdateScheduleShopStatusRequest;
use Modules\Barber\ScheduleShop\Services\ScheduleShopCRUDService;
use Modules\Client\Schedule\Presenters\SchedulePresenter;
use Modules\Client\Schedule\Services\GetScheduleSlotsService;
use Modules\Client\Schedule\Services\ScheduleCheckoutService;
use Ramsey\Uuid\Uuid;

class ScheduleShopController extends Controller
{
    public function __construct(
        private ScheduleShopCRUDService $scheduleShopService,
        private UpdateScheduleShopHandler $updateScheduleShopHandler,
        private DeleteScheduleShopHandler $deleteScheduleShopHandler,
        private ShopRepository $shopRepository,
        private UpdateScheduleShopStatusHandler $updateScheduleShopStatusHandler,
        private UpdateScheduleShopPaymentHandler $updateScheduleShopPaymentHandler,
        private ScheduleCheckoutService $scheduleCheckoutService,
         private GetScheduleSlotsService $getScheduleSlotsService,
    ) {
    }

    public function index(GetScheduleShopRequest $request)//: JsonResponse
    {

        $userId = auth('api_barbers')->user()->id;
        $barberId = Uuid::fromString($userId);
        $shop = $this->shopRepository->getMyShop($barberId);

         $schedule = $this->getScheduleSlotsService->get(
            Uuid::fromString($shop->id),
            $request->input('schedule_date'),
        );

         return Json::items($schedule);
    }
    public function store(CreateScheduleRequest $request)//: JsonResponse
    {
        $createScheduleDTO = $request->createCreateScheduleDTO();

        $userId = auth('api_barbers')->user()->id;
        $barberId = Uuid::fromString($userId);
        $shop = $this->shopRepository->getMyShop($barberId);
        $createScheduleDTO->shop_id = $shop->id;
        $createdItem = $this->scheduleShopService->create($createScheduleDTO);

        $presenter = new ScheduleShopPresenter($createdItem);

        return Json::item($presenter->getData());
    }
    public function mostSellingServices(GetScheduleShopListRequest $request): JsonResponse
    {
        $userId = auth('api_barbers')->user()->id;
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
    public function rate(GetScheduleShopListRequest $request): JsonResponse
    {
        $userId = auth('api_barbers')->user()->id;
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

    public function totalEarning(GetScheduleShopListRequest $request): JsonResponse
    {
        $userId = auth('api_barbers')->user()->id;
        $barberId = Uuid::fromString($userId);

        $shop = $this->shopRepository->getMyShop($barberId);

        $summary = $this->scheduleShopService->getTotalSummary(
            shopId: $shop->id,
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date')
        );


        return Json::item($summary);
    }

    public function booking(GetScheduleShopRequest $request)//: JsonResponse
    {
        $userId = auth('api_barbers')->user()->id;
        $barberId = Uuid::fromString($userId);
       return $shop = $this->shopRepository->getMyShop($barberId);

        $list = $this->scheduleShopService->list(
            shopId: $shop->id,
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 10)
        );

        return Json::items(ScheduleShopPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function showBookong(GetScheduleShopRequest $request): JsonResponse
    {
        $item = $this->scheduleShopService->get(Uuid::fromString($request->route('id')));

        $presenter = new ScheduleShopPresenter($item);

        return Json::item($presenter->getData());
    }
    public function checkout(GetScheduleShopRequest $request): JsonResponse
    {
        $scheduleId = Uuid::fromString($request->route('id'));
        $item = $this->scheduleCheckoutService->getBookingDetails($scheduleId);

        return Json::item($item);
    }

    public function statusBooking(UpdateScheduleShopStatusRequest $request): JsonResponse
    {
        $command = $request->updateScheduleShopStatusCommand();
        $this->updateScheduleShopStatusHandler->handle($command);

        $item = $this->scheduleShopService->get($command->getId());

        $presenter = new ScheduleShopPresenter($item);

        return Json::item($presenter->getData());
    }
    public function paymentsBooking(UpdateScheduleShopPaymentRequest $request): JsonResponse
    {
        $command = $request->updateScheduleShopStatusCommand();
        $this->updateScheduleShopPaymentHandler->handle($command);

        $item = $this->scheduleShopService->get($command->getId());

        $presenter = new ScheduleShopPresenter($item);

        return Json::item($presenter->getData());
    }

}

<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\Shop\Models\Shop;
use Modules\Client\Schedule\Handlers\DeleteScheduleHandler;
use Modules\Client\Schedule\Handlers\UpdateScheduleHandler;
use Modules\Client\Schedule\Presenters\ScheduleActivePresenter;
use Modules\Client\Schedule\Presenters\SchedulePresenter;
use Modules\Client\Schedule\Requests\CreateScheduleRequest;
use Modules\Client\Schedule\Requests\DeleteScheduleRequest;
use Modules\Client\Schedule\Requests\GetScheduleListRequest;
use Modules\Client\Schedule\Requests\GetScheduleRequest;
use Modules\Client\Schedule\Requests\UpdateScheduleRequest;
use Modules\Client\Schedule\Services\GetScheduleSlotsService;
use Modules\Client\Schedule\Services\ScheduleCRUDService;
use Modules\Client\Schedule\Services\GetScheduleDataService;
use Ramsey\Uuid\Uuid;

class ScheduleController extends Controller
{
    public function __construct(
        private ScheduleCRUDService $scheduleService,
        private UpdateScheduleHandler $updateScheduleHandler,
        private DeleteScheduleHandler $deleteScheduleHandler,
        private GetScheduleSlotsService $getScheduleSlotsService,
        private GetScheduleDataService $getScheduleDataService
    ) {
    }

    public function index(GetScheduleListRequest $request)//: JsonResponse
    {
         $schedule = $this->getScheduleSlotsService->get(
            Uuid::fromString($request->route('shop_id')),
            $request->input('schedule_date'),
        );

         return Json::items($schedule);
    }
    public function clientIndex(GetScheduleListRequest $request): JsonResponse
    {
        $list = $this->scheduleService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10),
            Uuid::fromString(auth('api_clients')->user()->id),
            'client_id'
        );

        return Json::items(SchedulePresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function store(CreateScheduleRequest $request): JsonResponse
    {
        $client = auth('api_clients')->user();
        $client_id = $client->id;

        if(!$client->is_active===1 ||!$client->is_active===true) {
            return Json::error('Client is not active', 403);
        }
        $shop = Shop::with('barber')->findOrFail($request->get('shop_id'));

        if(!$shop->barber->is_active === 1 || !$shop->barber->is_active === true) {
            return Json::error('Barber is not active', 403);
        }

        $this->scheduleService->checkClientScheduleLimit($client_id);

        $createScheduleDTO = $request->createCreateScheduleDTO();
        $createScheduleDTO->client_id =  $client_id;

        $createdItem = $this->scheduleService->create($createScheduleDTO);

        $presenter = new SchedulePresenter($createdItem);


        return Json::item($presenter->getData());
    }
    public function getData(CreateScheduleRequest $request): JsonResponse
    {
        $createScheduleDTO = $request->createCreateScheduleDTO();
        $createScheduleDTO->client_id = auth('api_clients')->user()->id;

        $createdItem = $this->getScheduleDataService->getBookingDetails($createScheduleDTO);

        return Json::item($createdItem);
    }
    public function show(GetScheduleRequest $request)//: JsonResponse
    {

        $client_id = auth('api_clients')->user()->id;

        $schedule = $this->scheduleService->get(Uuid::fromString($request->route('id')));

        $presenter = new ScheduleActivePresenter($schedule);

         return Json::item($presenter->getData());
    }

        public function update(UpdateScheduleRequest $request): JsonResponse
        {
            $updateScheduleCommand = $request->createUpdateScheduleCommand();
            $this->updateScheduleHandler->handle($updateScheduleCommand);

            $schedule = $this->scheduleService->get($updateScheduleCommand->getId());

            $this->scheduleService->sendNotificationCancelBooking($schedule);
            $this->scheduleService->sendNotificationCancelBookingToClient($schedule);
            $presenter = new ScheduleActivePresenter($schedule);

            return Json::item($presenter->getData());
        }
}

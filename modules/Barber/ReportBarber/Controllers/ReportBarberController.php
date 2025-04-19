<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Barber\ReportBarber\Handlers\DeleteReportBarberHandler;
use Modules\Barber\ReportBarber\Handlers\UpdateReportBarberHandler;
use Modules\Barber\ReportBarber\Presenters\ReportBarberPresenter;
use Modules\Barber\ReportBarber\Requests\CreateReportBarberRequest;
use Modules\Barber\ReportBarber\Requests\DeleteReportBarberRequest;
use Modules\Barber\ReportBarber\Requests\GetReportBarberListRequest;
use Modules\Barber\ReportBarber\Requests\GetReportBarberRequest;
use Modules\Barber\ReportBarber\Requests\UpdateReportBarberRequest;
use Modules\Barber\ReportBarber\Services\ReportBarberCRUDService;
use Modules\Barber\Shop\Repositories\ShopRepository;
use Ramsey\Uuid\Uuid;

class ReportBarberController extends Controller
{
    public function __construct(
        private ReportBarberCRUDService $reportBarberService,
        private UpdateReportBarberHandler $updateReportBarberHandler,
        private DeleteReportBarberHandler $deleteReportBarberHandler,
        private ShopRepository $shopRepository,
    ) {
    }

    public function index(GetReportBarberListRequest $request): JsonResponse
    {
        $list = $this->reportBarberService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ReportBarberPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetReportBarberRequest $request): JsonResponse
    {
        $item = $this->reportBarberService->get(Uuid::fromString($request->route('id')));

        $presenter = new ReportBarberPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateReportBarberRequest $request)//: JsonResponse
    {

        $userId = auth('api_barbers')->user()->id;
        $barberId = Uuid::fromString($userId);
        $shop = $this->shopRepository->getMyShop($barberId);

        $createCreateReportBarberDTO = $request->createCreateReportBarberDTO();

        $createCreateReportBarberDTO->shop_id = $shop->id;
        $createCreateReportBarberDTO->user_id = $userId;

        $createdItem = $this->reportBarberService->create($createCreateReportBarberDTO);

        $presenter = new ReportBarberPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateReportBarberRequest $request): JsonResponse
    {
        $command = $request->createUpdateReportBarberCommand();
        $this->updateReportBarberHandler->handle($command);

        $item = $this->reportBarberService->get($command->getId());

        $presenter = new ReportBarberPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteReportBarberRequest $request): JsonResponse
    {
        $this->deleteReportBarberHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

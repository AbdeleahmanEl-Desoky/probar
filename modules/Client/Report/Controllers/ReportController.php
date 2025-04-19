<?php

declare(strict_types=1);

namespace Modules\Client\Report\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Client\Report\Handlers\DeleteReportHandler;
use Modules\Client\Report\Handlers\UpdateReportHandler;
use Modules\Client\Report\Presenters\ReportPresenter;
use Modules\Client\Report\Requests\CreateReportRequest;
use Modules\Client\Report\Requests\DeleteReportRequest;
use Modules\Client\Report\Requests\GetReportListRequest;
use Modules\Client\Report\Requests\GetReportRequest;
use Modules\Client\Report\Requests\UpdateReportRequest;
use Modules\Client\Report\Services\ReportCRUDService;
use Ramsey\Uuid\Uuid;

class ReportController extends Controller
{
    public function __construct(
        private ReportCRUDService $reportService,
        private UpdateReportHandler $updateReportHandler,
        private DeleteReportHandler $deleteReportHandler,
    ) {
    }

    public function index(GetReportListRequest $request): JsonResponse
    {
        $list = $this->reportService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ReportPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetReportRequest $request): JsonResponse
    {
        $item = $this->reportService->get(Uuid::fromString($request->route('id')));

        $presenter = new ReportPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateReportRequest $request): JsonResponse
    {
        $createCreateReportDTO = $request->createCreateReportDTO();
        $createCreateReportDTO->user_id = auth('api_clients')->user()->id;

        $createdItem = $this->reportService->create($createCreateReportDTO);

        $presenter = new ReportPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateReportRequest $request): JsonResponse
    {
        $command = $request->createUpdateReportCommand();
        $this->updateReportHandler->handle($command);

        $item = $this->reportService->get($command->getId());

        $presenter = new ReportPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteReportRequest $request): JsonResponse
    {
        $this->deleteReportHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

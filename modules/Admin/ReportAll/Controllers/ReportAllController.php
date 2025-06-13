<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\ReportAll\Handlers\DeleteReportAllHandler;
use Modules\Admin\ReportAll\Handlers\UpdateReportAllHandler;
use Modules\Admin\ReportAll\Presenters\ReportAllPresenter;
use Modules\Admin\ReportAll\Requests\CreateReportAllRequest;
use Modules\Admin\ReportAll\Requests\DeleteReportAllRequest;
use Modules\Admin\ReportAll\Requests\GetReportAllListRequest;
use Modules\Admin\ReportAll\Requests\GetReportAllRequest;
use Modules\Admin\ReportAll\Requests\UpdateReportAllRequest;
use Modules\Admin\ReportAll\Services\ReportAllCRUDService;
use Ramsey\Uuid\Uuid;

class ReportAllController extends Controller
{
    public function __construct(
        private ReportAllCRUDService $reportAllService,
        private UpdateReportAllHandler $updateReportAllHandler,
        private DeleteReportAllHandler $deleteReportAllHandler,
    ) {
    }

    public function index(GetReportAllListRequest $request): JsonResponse
    {
        $list = $this->reportAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );

        return Json::items(ReportAllPresenter::collection($list['data']), paginationSettings: $list['pagination']);
    }

    public function show(GetReportAllRequest $request): JsonResponse
    {
        $item = $this->reportAllService->get(Uuid::fromString($request->route('id')));

        $presenter = new ReportAllPresenter($item);

        return Json::item($presenter->getData());
    }

    public function store(CreateReportAllRequest $request): JsonResponse
    {
        $createdItem = $this->reportAllService->create($request->createCreateReportAllDTO());

        $presenter = new ReportAllPresenter($createdItem);

        return Json::item($presenter->getData());
    }

    public function update(UpdateReportAllRequest $request): JsonResponse
    {
        $command = $request->createUpdateReportAllCommand();
        $this->updateReportAllHandler->handle($command);

        $item = $this->reportAllService->get($command->getId());

        $presenter = new ReportAllPresenter($item);

        return Json::item( $presenter->getData());
    }

    public function delete(DeleteReportAllRequest $request): JsonResponse
    {
        $this->deleteReportAllHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

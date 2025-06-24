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
    ) {
    }

    public function index(GetReportAllListRequest $request)
    {
        $list = $this->reportAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        $list->setCollection(collect(ReportAllPresenter::collection($list->items())));

        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('report::index', [
            'reports' => $list,
            'pagination' => $pagination,
        ]);
    }
}

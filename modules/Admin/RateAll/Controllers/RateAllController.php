<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\RateAll\Handlers\DeleteRateAllHandler;
use Modules\Admin\RateAll\Handlers\UpdateRateAllHandler;
use Modules\Admin\RateAll\Presenters\RateAllPresenter;
use Modules\Admin\RateAll\Requests\CreateRateAllRequest;
use Modules\Admin\RateAll\Requests\DeleteRateAllRequest;
use Modules\Admin\RateAll\Requests\GetRateAllListRequest;
use Modules\Admin\RateAll\Requests\GetRateAllRequest;
use Modules\Admin\RateAll\Requests\UpdateRateAllRequest;
use Modules\Admin\RateAll\Services\RateAllCRUDService;
use Ramsey\Uuid\Uuid;

class RateAllController extends Controller
{
    public function __construct(
        private RateAllCRUDService $rateAllService,
    ) {
    }

    public function index(GetRateAllListRequest $request)
    {
        $list = $this->rateAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        $list->setCollection(collect(RateAllPresenter::collection($list->items())));

        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('rate::index', [
            'rates' => $list,
            'pagination' => $pagination,
        ]);
    }
}

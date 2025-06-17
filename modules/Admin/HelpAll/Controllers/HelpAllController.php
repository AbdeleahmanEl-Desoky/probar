<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\HelpAll\Handlers\DeleteHelpAllHandler;
use Modules\Admin\HelpAll\Handlers\UpdateHelpAllHandler;
use Modules\Admin\HelpAll\Presenters\HelpAllPresenter;
use Modules\Admin\HelpAll\Requests\CreateHelpAllRequest;
use Modules\Admin\HelpAll\Requests\DeleteHelpAllRequest;
use Modules\Admin\HelpAll\Requests\GetHelpAllListRequest;
use Modules\Admin\HelpAll\Requests\GetHelpAllRequest;
use Modules\Admin\HelpAll\Requests\UpdateHelpAllRequest;
use Modules\Admin\HelpAll\Services\HelpAllCRUDService;
use Ramsey\Uuid\Uuid;

class HelpAllController extends Controller
{
    public function __construct(
        private HelpAllCRUDService $helpAllService,

    ) {
    }


    public function index(GetHelpAllListRequest $request)
    {
        $list = $this->helpAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
        $list->setCollection(collect(HelpAllPresenter::collection($list->items())));

        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('help::index', [
            'helpMessages' => $list,
            'pagination' => $pagination,
        ]);
    }
}

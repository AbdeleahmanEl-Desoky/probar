<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Admin\ScheduleAll\Handlers\DeleteScheduleAllHandler;
use Modules\Admin\ScheduleAll\Handlers\UpdateScheduleAllHandler;
use Modules\Admin\ScheduleAll\Presenters\ScheduleAllPresenter;
use Modules\Admin\ScheduleAll\Requests\CreateScheduleAllRequest;
use Modules\Admin\ScheduleAll\Requests\DeleteScheduleAllRequest;
use Modules\Admin\ScheduleAll\Requests\GetScheduleAllListRequest;
use Modules\Admin\ScheduleAll\Requests\GetScheduleAllRequest;
use Modules\Admin\ScheduleAll\Requests\UpdateScheduleAllRequest;
use Modules\Admin\ScheduleAll\Services\ScheduleAllCRUDService;
use Ramsey\Uuid\Uuid;

class ScheduleAllController extends Controller
{
    public function __construct(
        private ScheduleAllCRUDService $scheduleAllService,
    ) {
    }

    public function index(GetScheduleAllListRequest $request)
    {
        $list = $this->scheduleAllService->list(
            (int) $request->get('page', 1),
            (int) $request->get('per_page', 10)
        );
            $tab = 'all';
            if ($request->get('active') === 'yes') {
                $tab = 'active';
            } elseif ($request->get('upcoming') === 'yes') {
                $tab = 'upcoming';
            } elseif ($request->get('history') === 'yes') {
                $tab = 'history';
            }

        $list->setCollection(collect(ScheduleAllPresenter::collection($list->items())));

        // extract pagination info
        $pagination = [
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
        ];

        return view('schedule::index', [
            'schedules' => $list,
            'pagination' => $pagination,
            'tab' => $tab,
        ]);
    }

}

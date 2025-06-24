<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Controllers;

use App\Presenters\Json;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Barber\Models\Barber;
use Modules\Admin\CoreAdmin\Handlers\DeleteCoreAdminHandler;
use Modules\Admin\CoreAdmin\Handlers\UpdateCoreAdminHandler;
use Modules\Admin\CoreAdmin\Presenters\CoreAdminPresenter;
use Modules\Admin\CoreAdmin\Requests\CreateCoreAdminRequest;
use Modules\Admin\CoreAdmin\Requests\DeleteCoreAdminRequest;
use Modules\Admin\CoreAdmin\Requests\GetCoreAdminListRequest;
use Modules\Admin\CoreAdmin\Requests\GetCoreAdminRequest;
use Modules\Admin\CoreAdmin\Requests\UpdateCoreAdminRequest;
use Modules\Admin\CoreAdmin\Services\CoreAdminCRUDService;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopService\Models\ShopService;
use Modules\Client\CoreClient\Models\Client;
use Modules\Client\Schedule\Models\Schedule;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class CoreAdminController extends Controller
{
    public function __construct(
        private CoreAdminCRUDService $coreAdminService,
        private UpdateCoreAdminHandler $updateCoreAdminHandler,
        private DeleteCoreAdminHandler $deleteCoreAdminHandler,
    ) {
    }

    // public function index(GetCoreAdminListRequest $request): View
    public function index(): View
    {
        // 1. إحصائيات الحلاقين (Barbers)
        $totalBarbers = Barber::count();
        $activeBarbers = Barber::where('is_active', 1)->count(); // افتراض وجود حقل status
        $inactiveBarbers = $totalBarbers - $activeBarbers;

        // 2. إحصائيات العملاء (Clients)
        $totalClients = Client::count();
        // العميل النشط هو الذي لديه حجز واحد على الأقل ليس منتهي أو ملغي
        $activeClients = Client::where('is_active', 1)->count();
        $inactiveClients = $totalClients - $activeClients;

        // 3. إحصائيات الحجوزات (Schedules)
        $totalSchedules = Schedule::count();
        $finishedSchedules = Schedule::where('status', 'finished')->count();
        $upcomingSchedules = Schedule::where('schedule_date', '>', Carbon::now())
                                      ->whereNotIn('status', ['finished', 'cancel'])
                                      ->count();
        // الحجوزات النشطة هي كل الحجوزات التي لم تنتهِ أو تُلغى بعد
        $activeSchedules = Schedule::whereNotIn('status', ['finished', 'cancel'])->count();

        // 4. إحصائيات المحلات (Shops)
        $totalShops = Shop::count();

        // 5. إحصائيات الخدمات (Services)
        $totalServices = ShopService::count();

        // 6. بيانات الرسم البياني (لآخر 12 شهر)
        $schedulesChartData = Schedule::query()
            ->select([
                DB::raw('YEAR(schedule_date) as year'),
                DB::raw('MONTH(schedule_date) as month'),
                DB::raw('COUNT(*) as sum')
            ])
            ->where('schedule_date', '>=', Carbon::now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();


        return view('admin::dashboard.welcome', [
            'title' => __('site.dashboard'),
            'description' => 'إحصائيات عامة للنظام.',
            'totalBarbers' => $totalBarbers,
            'activeBarbers' => $activeBarbers,
            'inactiveBarbers' => $inactiveBarbers,
            'totalClients' => $totalClients,
            'activeClients' => $activeClients,
            'inactiveClients' => $inactiveClients,
            'totalSchedules' => $totalSchedules,
            'finishedSchedules' => $finishedSchedules,
            'upcomingSchedules' => $upcomingSchedules,
            'activeSchedules' => $activeSchedules,
            'totalShops' => $totalShops,
            'totalServices' => $totalServices,
            'schedules_chart_data' => $schedulesChartData,

        ]);
    }


    public function show(GetCoreAdminRequest $request): JsonResponse
    {
        $item = $this->coreAdminService->get(Uuid::fromString($request->route('id')));

        $presenter = new CoreAdminPresenter($item);

        return Json::buildItems('core_admin', $presenter->getData());
    }

    public function store(CreateCoreAdminRequest $request): JsonResponse
    {
        $createdItem = $this->coreAdminService->create($request->createCreateCoreAdminDTO());

        $presenter = new CoreAdminPresenter($createdItem);

        return Json::buildItems('core_admin', $presenter->getData());
    }

    public function update(UpdateCoreAdminRequest $request): JsonResponse
    {
        $command = $request->createUpdateCoreAdminCommand();
        $this->updateCoreAdminHandler->handle($command);

        $item = $this->coreAdminService->get($command->getId());

        $presenter = new CoreAdminPresenter($item);

        return Json::buildItems('core_admin', $presenter->getData());
    }

    public function delete(DeleteCoreAdminRequest $request): JsonResponse
    {
        $this->deleteCoreAdminHandler->handle(Uuid::fromString($request->route('id')));

        return Json::deleted();
    }
}

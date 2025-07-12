<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use App\Jobs\SendScheduleReminderJob;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;
use Modules\Client\Schedule\DTO\CreateScheduleDTO;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;
use Modules\Client\Shops\Repositories\ShopsRepository;
use Modules\Shared\Notification\Services\FirebaseNotificationService;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class ScheduleCRUDService
{
    public function __construct(
        private ScheduleRepository $repository,
        private FirebaseNotificationService $firebaseNotificationService,
        private ShopsRepository $shopsRepository,

        private CoreBarberRepository $coreBarberRepository,

    ) {
    }

    public function create(CreateScheduleDTO $createScheduleDTO): Schedule
    {
        $schedule = $this->repository->createSchedule($createScheduleDTO->toArray());

        self::sendNotificationBookingToBarber($schedule);
        self::sendNotificationBookingToClient($schedule);

        $reminderTime = Carbon::parse($schedule->schedule_date . ' ' . $schedule->start_time)
        ->subMinutes(10);
        SendScheduleReminderJob::dispatch($schedule)->delay($reminderTime);

        return $schedule;
    }

    public function sendNotificationBookingToBarber(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));

        $barber = $this->coreBarberRepository->getCoreBarber(Uuid::fromString($shop->barber_id));
        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $barber->fcm_token??'@',
       __('notifications.new_schedule_title'),
        __('notifications.new_schedule_body', [
            'client_name' => $client->name,
            'time' => Carbon::parse($schedule->start_time)->format('H:i'), // format it as you need
            'date' => Carbon::parse($schedule->schedule_date)->format('Y-m-d'), // format it as you need

        ]),
            [
                'type' => 'schedule_new',
                'schedule_id' => $schedule->id,
            ]
        );
    }

    public function sendNotificationBookingToClient(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));
        $client = auth('api_clients')->user();


        $this->firebaseNotificationService->send(
            $client->fcm_token??'@',
            __('notifications.new_schedule_title_client'),
            __('notifications.new_schedule_body_client', [
                'shop_name' => $shop->name,
                'time' => Carbon::parse($schedule->start_time)->format('H:i'),
                'date' => Carbon::parse($schedule->schedule_date)->format('d/m'),
            ]),
            [
                'type' => 'schedule_new',
                'schedule_id' => $schedule->id,
            ]
        );
    }

    public function sendNotificationCancelBooking(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));

        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $shop->barber->fcm_token??"@",
       __('notifications.cancel_schedule_title'),
        __('notifications.cancel_schedule_body', [
            'client_name' => $client->name,
            'time' => Carbon::parse($schedule->start_time)->format('H:i'),
            'date' => Carbon::parse($schedule->schedule_date)->format('d/m'),
        ]),
            [
                'type' => 'schedule_cancel',
                'schedule_id' => $schedule->id,
            ]
        );
    }
    public function sendNotificationCancelBookingToClient(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));

        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $client->fcm_token??"@",
       __('notifications.cancel_schedule_title_client'),
        __('notifications.cancel_schedule_body_client', [
            'shop_name' => $shop->name,
            'time' => Carbon::parse($schedule->start_time)->format('H:i'),
            'date' => Carbon::parse($schedule->schedule_date)->format('d/m'),
        ]),
            [
                'type' => 'schedule_cancel',
                'schedule_id' => $schedule->id,
            ]
        );
    }
    public function list(int $page = 1, int $perPage = 10,$shopId,$model): array
    {
        return $this->repository->paginated(
            [$model=>$shopId],
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Schedule
    {
        return $this->repository->getSchedule(
            id: $id,
        );
    }


    public function checkClientScheduleLimit( $clientId)
    {
        $activeStatuses =  Config::get('schedule.active_statuses', ['pending']);
        $maxAllowed =  Config::get('schedule.max_active_schedules_per_client', 3);

        $activeSchedulesCount = Schedule::where('client_id', $clientId)
            ->whereIn('status', $activeStatuses)
            ->where('schedule_date', '>=', Carbon::now()->startOfDay())
            ->count();

        if ($activeSchedulesCount >= $maxAllowed) {
            abort(response()->json([
                'message' => __("لا يمكن الحجز، لقد تجاوزت الحد الأقصى لعدد الحجوزات ($maxAllowed)."),
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}

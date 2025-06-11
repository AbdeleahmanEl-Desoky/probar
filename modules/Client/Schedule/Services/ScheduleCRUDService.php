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

        $reminderTime = Carbon::parse($schedule->start_time)->subMinutes(10);

        SendScheduleReminderJob::dispatch($schedule)->delay($reminderTime);

        return $schedule;
    }

    public function sendNotificationBookingToBarber(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));

        $barber = $this->coreBarberRepository->getCoreBarber(Uuid::fromString($shop->barber_id));
        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $barber->fcm_token,
       __('notifications.new_schedule_title'),
        __('notifications.new_schedule_body', [
            'client_name' => $client->name,
            'time' => $schedule->start_time->toString(),
            'date' => $schedule->schedule_date->toString(),
        ]),
            [
                'type' => 'schedule_new',
                'schedule_id' => $schedule->id->toString(),
                'schedule_date' => $schedule->schedule_date->toString(),
                'schedule_time' => $schedule->start_time->toString(),
            ]
        );
    }

        public function sendNotificationBookingToClient(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));
        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $barber->fcm_token,
       __('notifications.new_schedule_title'),
        __('notifications.new_schedule_body', [
            'client_name' => $client->name,
            'time' => $schedule->start_time->toString(),
            'date' => $schedule->schedule_date->toString(),
        ]),
            [
                'type' => 'schedule_new',
                'schedule_id' => $schedule->id->toString(),
                'schedule_date' => $schedule->schedule_date->toString(),
                'schedule_time' => $schedule->start_time->toString(),
            ]
        );
    }

    public function sendNotificationCancelBooking(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($schedule->shop_id));

        $barber = $this->coreBarberRepository->getCoreBarber(Uuid::fromString($shop->barber_id));
        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $barber->fcm_token,
       __('notifications.cancel_schedule_title'),
        __('notifications.cancel_schedule_body', [
            'client_name' => $client->name,
            'time' => $schedule->start_time->toString(),
            'date' => $schedule->schedule_date->toString(),
        ]),
            [
                'type' => 'schedule_cancel',
                'schedule_id' => $schedule->id->toString(),
                'schedule_date' => $schedule->schedule_date->toString(),
                'schedule_time' => $schedule->start_time->toString(),
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
}

<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

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
        self::sendNotification($schedule);

        return $schedule;
    }

    public function sendNotification(Schedule $schedule): void
    {
        $shop = $this->shopsRepository->getShops(Uuid::fromString($createScheduleDTO->shop_id));

        $barber = $this->coreBarberRepository->getCoreBarber(Uuid::fromString($shop->barber_id));
        $client = auth('api_clients')->user();

        $this->firebaseNotificationService->send(
             $barber->fcm_token,
       __('messages.new_schedule_title'),
        __('messages.new_schedule_body', [
            'client_name' => $client->name,
            'time' => $schedule->start_time,
            'date' => $schedule->schedule_date,
        ]),
            [
                'type' => 'schedule_new',
                'schedule_id' => $schedule->id->toString(),
                'schedule_date' => $schedule->schedule_date,
                'schedule_time' => $schedule->start_time,
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

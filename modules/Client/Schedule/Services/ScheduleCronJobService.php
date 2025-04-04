<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Services;

use Illuminate\Support\Collection;
use Modules\Client\Schedule\DTO\CreateScheduleDTO;
use Modules\Client\Schedule\Models\Schedule;
use Modules\Client\Schedule\Repositories\ScheduleRepository;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
class ScheduleCronJobService
{
    public function __construct(
        private ScheduleRepository $repository,
        private ScheduleCRUDService $scheduleService,
    ) {
    }

    public function createSchedule()
    {
        try {
            // Example: create a daily schedule
            $dto = new CreateScheduleDTO(
                start_time: '09:00:00',
                end_time: '17:00:00',
                schedule_date: now()->toDateString(),
                shop_id: 'your-shop-id',
                client_id:null,
                status: 'pending',
                note: null,
                services: [],
            );

            $this->scheduleService->create($dto);

            $this->info('Schedule created successfully.');
            return Command::SUCCESS;

        } catch (\Exception $e) {
            Log::error('Error creating schedule: ' . $e->getMessage());
            $this->error('An error occurred while creating the schedule.');
            return Command::FAILURE;
        }
    }

}

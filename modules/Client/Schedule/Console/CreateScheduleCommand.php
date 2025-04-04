<?php

namespace Modules\Client\Schedule\Console;

use Illuminate\Console\Command;

use Modules\Client\Schedule\Services\ScheduleCronJobService;

class CreateScheduleCommand extends Command
{
    protected $signature = 'schedule:create-daily';

    protected $description = 'Create daily schedules at 12:05 AM';

    protected ScheduleCronJobService $ScheduleCronJobService;

    public function __construct(ScheduleCronJobService $ScheduleCronJobService)
    {
        parent::__construct();
        $this->ScheduleCronJobService = $ScheduleCronJobService;
    }

    public function handle()
    {
        $this->ScheduleCronJobService->createSchedule();
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Shared\Notification\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Log;
use Modules\Client\Schedule\Models\Schedule;

class SendScheduleReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

 public function handle(): void
    {
        $client = $this->schedule->client;

        $title = __('notifications.reminder_title');
        $body = __('notifications.reminder_body');

        FirebaseNotificationService::send(
            $client->fcm_token??'@',
            $title,
            $body,
            [
                'type' => 'schedule_reminder',
                'schedule_id' => $this->schedule->id->toString(),
                'schedule_date' => $this->schedule->schedule_date,
                'schedule_time' => $this->schedule->start_time,
            ]
        );
    }
}

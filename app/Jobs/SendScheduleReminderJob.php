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
    protected $scheduleId;

    public function __construct(string $scheduleId)
    {
        $this->scheduleId = $scheduleId;
    }

    public function handle(): void
    {
        $schedule = Schedule::with('client')->findOrFail($this->scheduleId);

        $client = $schedule->client;

        if (!$client?->fcm_token) {
            Log::warning("Missing FCM token", ['schedule_id' => $this->scheduleId]);
            return;
        }

        $title = __('notifications.reminder_title');
        $body = __('notifications.reminder_body');

        FirebaseNotificationService::send(
            $client->fcm_token,
            $title,
            $body,
            [
                'type' => 'schedule_reminder',
                'schedule_id' => $schedule->id,
                'schedule_date' => $schedule->schedule_date,
                'schedule_time' => $schedule->start_time,
            ]
            );
    }
}

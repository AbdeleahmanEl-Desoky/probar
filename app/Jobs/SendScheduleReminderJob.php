<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Shared\Notification\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\Log;

class SendScheduleReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $fcmTokens;

    public function __construct(array $fcmTokens)
    {
        $this->fcmTokens = $fcmTokens;
    }

    public function handle(): void
    {
        $firebaseNotificationService = app(FirebaseNotificationService::class);

        foreach ($this->fcmTokens as $token) {
            try {
                $firebaseNotificationService->send(
                    $token,
                    __('notifications.new_schedule_title'),
                    __('notifications.new_schedule_title'),
                    [
                        'type' => 'test_notification',
                        'message' => 'This is a test notification.',
                    ]
                );
            } catch (\Exception $e) {
                Log::error("FCM Error: " . $e->getMessage());
                Log::error("Invalid Token: " . $token);
            }
        }

        Log::info('✅ SendScheduleReminderJob executed successfully!');
    }
}

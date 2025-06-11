<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Shared\Notification\Services\FirebaseNotificationService;
use Illuminate\Support\Facades\App;
use Modules\Client\CoreClient\Models\Client;
use Modules\Client\Schedule\Models\Schedule;
use Illuminate\Foundation\Bus\Dispatchable;
class SendScheduleReminderJob implements ShouldQueue
{
    use Dispatchable,InteractsWithQueue, Queueable, SerializesModels;

    protected $schedule;

    public function __construct(        private FirebaseNotificationService $firebaseNotificationService,
)
    {

    }

    public function handle(): void
    {
        $FcmToken = Client::whereNotNull('fcm_token')->get();

        foreach ($FcmToken as $token) {
            // Send a test notification
            $this->firebaseNotificationService->send(
                $token->fcm_token,
                __('notifications.new_schedule_title'),
                __('notifications.new_schedule_title'),
                [
                    'type' => 'test_notification',
                    'message' => 'This is a test notification.',
                ]
            );
        }

        // $client = $this->schedule->client;

        // // تأكد من اللغة
        // App::setLocale($client->locale ?? 'ar');

        // $title = __('messages.reminder_title');
        // $body = __('messages.reminder_body');

        // // أرسل الإشعار
        // FirebaseNotificationService::send(
        //     $client->fcm_token,
        //     $title,
        //     $body
        // );
    }
}

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

class SendScheduleReminderJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $schedule;

    public function __construct()
    {

    }

    public function handle(): void
    {
    $FcmToken = Client::whereNotNull('fcm_token')->get();

        foreach ($FcmToken as $token) {
            // Send a test notification
            FirebaseNotificationService::send(
                $token,
                'Reminder',
                'This is a reminder for your upcoming schedule.',
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

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

    public function __construct()
    {

    }

    public function handle(): void
    {
    $FcmToken = Client::whereNotNull('fcm_token')->get();
        \Log::info('✅ SendScheduleReminderJob executed successfully!');

foreach ($FcmToken as $token) {
    if (empty($token->fcm_token) || strlen($token->fcm_token) < 100) {
        \Log::warning("⚠️ Skipping invalid FCM token: " . $token->fcm_token);
        continue;
    }

    FirebaseNotificationService::send(
        $token->fcm_token,
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

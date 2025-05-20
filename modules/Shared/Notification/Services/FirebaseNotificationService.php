<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Services;


use Illuminate\Support\Facades\Http;

class FirebaseNotificationService
{
    public static function send(string $fcmToken, string $title, string $body, array $data = []): bool
    {
        $SERVER_API_KEY = config('services.fcm.server_key');

        $response = Http::withHeaders([
            'Authorization' => 'key=' . $SERVER_API_KEY,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'to' => $fcmToken,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
            ],
            'data' => $data,
        ]);

        return $response->successful();
    }
}

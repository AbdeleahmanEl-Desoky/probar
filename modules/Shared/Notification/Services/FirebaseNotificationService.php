<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationService
{
    protected static function messaging()
    {
        $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
        return $factory->createMessaging();
    }

    public static function send(string $fcmToken, string $title, string $body, array $data = []): bool
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('token', $fcmToken)
            ->withNotification($notification)
            ->withData($data);

        try {
            self::messaging()->send($message);
            return true;
        } catch (\Throwable $e) {
            \Log::error('FCM Error: ' . $e->getMessage());
            return false;
        }
    }
}

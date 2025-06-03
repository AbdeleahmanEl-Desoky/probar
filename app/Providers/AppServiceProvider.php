<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\Messaging;
use Modules\Shared\Notification\Services\FirebaseNotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the Kreait Firebase Messaging client as a singleton
        $this->app->singleton(Messaging::class, function ($app) {
            $credentialsPath = config('services.firebase.credentials.file');
            if (!$credentialsPath || !file_exists($credentialsPath)) {
                // Log an error or throw an exception if credentials are not set/found
                \Log::error('Firebase credentials file not found or path not configured.', ['path' => $credentialsPath]);
                // Optionally, return a null object or throw an exception to halt if critical
                // For now, we'll let Kreait potentially handle it, though it's better to check here.
            }

            $factory = (new Factory)->withServiceAccount($credentialsPath);
            return $factory->createMessaging();
        });

        // Register your FirebaseNotificationService, injecting the Messaging client
        $this->app->singleton(FirebaseNotificationService::class, function ($app) {
            return new FirebaseNotificationService($app->make(Messaging::class));
        });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

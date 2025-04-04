<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule as ScheduleConsole;
class ScheduleServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'Schedule';
    }

    public function boot(): void
    {
        $this->registerTranslations();
        //$this->registerConfig();
        $this->registerSchedules();
        $this->registerMigrations();
    }

    public function register(): void
    {
        $this->registerRoutes();
        $this->commands([
            \Modules\Client\Schedule\Console\CreateScheduleCommand::class,
        ]);
    }


    public function registerSchedules(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(ScheduleConsole::class);
            $schedule->command('schedule:create-daily')->dailyAt('00:05');
        });
    }
    public function mapRoutes(): void
    {
        Route::prefix('api/v1/clients/schedules')
            ->middleware('api')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

    }
}

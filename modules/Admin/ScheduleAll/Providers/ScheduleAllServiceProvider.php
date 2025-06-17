<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ScheduleAllServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ScheduleAll';
    }

    public function boot(): void
    {
        $this->loadViewsFrom($this->getModulePath() . '/Resources/views', 'schedule');
        $this->registerTranslations();
        //$this->registerConfig();
        $this->registerMigrations();
    }

    public function register(): void
    {
        $this->registerRoutes();
    }

    public function mapRoutes(): void
    {
        Route::middleware('web')
        ->prefix('admin/schedules')
        ->name('admin.schedules.')
        ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

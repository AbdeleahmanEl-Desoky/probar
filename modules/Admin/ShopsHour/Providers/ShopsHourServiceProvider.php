<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ShopsHourServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ShopsHour';
    }

    public function boot(): void
    {
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
        ->prefix('admin/shops-hours')
        ->name('admin.shops-hours.')
        ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

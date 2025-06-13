<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class RateAllServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'RateAll';
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
        ->prefix('admin/rates')
        ->name('admin.rates.')
        ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

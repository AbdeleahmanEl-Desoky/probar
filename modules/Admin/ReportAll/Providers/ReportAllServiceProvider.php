<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ReportAllServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ReportAll';
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
        ->prefix('admin/reports')
        ->name('admin.reports.')
        ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

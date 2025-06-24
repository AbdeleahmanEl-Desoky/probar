<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ShopsServiceServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ShopsService';
    }

    public function boot(): void
    {
        $this->mapRoutes();
        $this->loadViewsFrom($this->getModulePath() . '/Resources/views', 'shops-service');
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
        ->prefix('admin/shops-services')
        ->name('admin.shops-services.')
        ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

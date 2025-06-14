<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ShopBarberServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ShopBarber';
    }

    public function boot(): void
    {
        $this->loadViewsFrom($this->getModulePath() . '/Resources/views', 'shop');
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
        ->prefix('admin/shops')
        ->name('admin.shops.')
        ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

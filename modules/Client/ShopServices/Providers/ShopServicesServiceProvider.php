<?php

declare(strict_types=1);

namespace Modules\Client\ShopServices\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ShopServicesServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ShopServices';
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
        Route::prefix('api/v1/clients/shop_services')
            ->middleware('api')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

    }
}

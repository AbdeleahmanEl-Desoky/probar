<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ShopServiceServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'ShopService';
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
        Route::prefix('api/v1/barber/shop_services')
            ->middleware('api')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

    }
}

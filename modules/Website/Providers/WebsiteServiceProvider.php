<?php

declare(strict_types=1);

namespace Modules\Website\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class WebsiteServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'Website';
    }

    public function boot(): void
    {
        $this->registerTranslations();
        //$this->registerConfig();
        $this->registerMigrations();
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'website');

    }

    public function register(): void
    {
        $this->registerRoutes();
    }

    public function mapRoutes(): void
    {
        Route::middleware('web')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

    }
}

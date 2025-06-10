<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class CoreAdminServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'CoreAdmin';
    }

    public function boot(): void
    {
        $this->loadViewsFrom($this->getModulePath() . '/Resources/views', 'admin');
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
            ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

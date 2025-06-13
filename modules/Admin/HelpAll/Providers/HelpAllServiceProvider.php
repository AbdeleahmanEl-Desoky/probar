<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class HelpAllServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'HelpAll';
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
            ->prefix('admin/helps')
            ->name('admin.helps.')
            ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

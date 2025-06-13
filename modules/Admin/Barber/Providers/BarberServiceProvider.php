<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class BarberServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'Barber';
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
            ->prefix('admin/barbers')
            ->name('admin.barbers.')
            ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

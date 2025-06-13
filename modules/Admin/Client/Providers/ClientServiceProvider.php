<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class ClientServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'Client';
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
            ->prefix('admin/clients')
            ->name('admin.clients.')
            ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

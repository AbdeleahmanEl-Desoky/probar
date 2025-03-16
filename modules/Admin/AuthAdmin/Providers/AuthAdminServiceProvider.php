<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class AuthAdminServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'AuthAdmin';
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
        Route::prefix('api/v1/auth_admins')
            ->middleware('api')
            ->group($this->getModulePath() . '/Resources/routes/api.php');

    }
}

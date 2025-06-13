<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class FavoriteClientServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'FavoriteClient';
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
            ->prefix('admin/favorites')
            ->name('admin.favorites.')
            ->group($this->getModulePath() . '/Resources/routes/web.php');

    }
}

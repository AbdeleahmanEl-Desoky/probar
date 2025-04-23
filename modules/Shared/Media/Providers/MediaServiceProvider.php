<?php

declare(strict_types=1);

namespace Modules\Shared\Media\Providers;

use Illuminate\Support\Facades\Route;
use BasePackage\Shared\Module\ModuleServiceProvider;

class MediaServiceProvider extends ModuleServiceProvider
{
    public static function getModuleName(): string
    {
        return 'Media';
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


}

<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Version\Controllers\VersionController;

    Route::get('/', [VersionController::class, 'index']);

    Route::post('/', [VersionController::class, 'update']);
    

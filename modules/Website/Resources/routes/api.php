<?php

use Illuminate\Support\Facades\Route;
use Modules\Website\Controllers\WebsiteController;

    Route::get('/', [WebsiteController::class, 'home'])->name('home');
    Route::get('privacy-policy', [WebsiteController::class, 'privacy'])->name('privacy');
    Route::get('terms-conditions', [WebsiteController::class, 'terms'])->name('terms');



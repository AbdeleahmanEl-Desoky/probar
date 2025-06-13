<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Client\Controllers\ClientController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('index');
});

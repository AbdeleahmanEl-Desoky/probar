<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ShopsHour\Controllers\ShopsHourController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ShopsHourController::class, 'index']);
    Route::post('/', [ShopsHourController::class, 'store']);
    Route::get('/{id}', [ShopsHourController::class, 'show']);
    Route::put('/{id}', [ShopsHourController::class, 'update']);
    Route::delete('/{id}', [ShopsHourController::class, 'delete']);
});

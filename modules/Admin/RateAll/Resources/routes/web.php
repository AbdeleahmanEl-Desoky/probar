<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\RateAll\Controllers\RateAllController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [RateAllController::class, 'index']);
    Route::post('/', [RateAllController::class, 'store']);
    Route::get('/{id}', [RateAllController::class, 'show']);
    Route::put('/{id}', [RateAllController::class, 'update']);
    Route::delete('/{id}', [RateAllController::class, 'delete']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\HelpAll\Controllers\HelpAllController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [HelpAllController::class, 'index']);
    Route::post('/', [HelpAllController::class, 'store']);
    Route::get('/{id}', [HelpAllController::class, 'show']);
    Route::put('/{id}', [HelpAllController::class, 'update']);
    Route::delete('/{id}', [HelpAllController::class, 'delete']);
});

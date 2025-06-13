<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Client\Controllers\ClientController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::post('/', [ClientController::class, 'store']);
    Route::get('/{id}', [ClientController::class, 'show']);
    Route::put('/{id}', [ClientController::class, 'update']);
    Route::delete('/{id}', [ClientController::class, 'delete']);
});

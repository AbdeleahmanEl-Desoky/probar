<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ShopsService\Controllers\ShopsServiceController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ShopsServiceController::class, 'index']);
    Route::post('/', [ShopsServiceController::class, 'store']);
    Route::get('/{id}', [ShopsServiceController::class, 'show']);
    Route::put('/{id}', [ShopsServiceController::class, 'update']);
    Route::delete('/{id}', [ShopsServiceController::class, 'delete']);
});

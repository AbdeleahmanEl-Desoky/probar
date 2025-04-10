<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Rate\Controllers\RateController;

Route::group(['middleware' => ['auth:api_clients']], function () {
    // Route::get('/', [RateController::class, 'index']);
    Route::post('/', [RateController::class, 'store']);
    // Route::get('/{id}', [RateController::class, 'show']);
    // Route::put('/{id}', [RateController::class, 'update']);
    // Route::delete('/{id}', [RateController::class, 'delete']);
});

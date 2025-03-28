<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Shops\Controllers\ShopsController;

Route::group(['middleware' => ['auth:api_clients']], function () {
    Route::get('/', [ShopsController::class, 'index']);
    Route::post('/', [ShopsController::class, 'store']);
    Route::get('/{id}', [ShopsController::class, 'show']);
    Route::put('/{id}', [ShopsController::class, 'update']);
    Route::delete('/{id}', [ShopsController::class, 'delete']);
});

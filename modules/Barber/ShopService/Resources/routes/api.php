<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\ShopService\Controllers\ShopServiceController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [ShopServiceController::class, 'index']);
    Route::post('/', [ShopServiceController::class, 'store']);
    Route::get('/{id}', [ShopServiceController::class, 'show']);
    Route::put('/{id}', [ShopServiceController::class, 'update']);
    Route::delete('/{id}', [ShopServiceController::class, 'delete']);
});

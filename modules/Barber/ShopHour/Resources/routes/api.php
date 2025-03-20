<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\ShopHour\Controllers\ShopHourController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [ShopHourController::class, 'index']);
    Route::post('/', [ShopHourController::class, 'store']);
    Route::get('/{id}', [ShopHourController::class, 'show']);
    Route::put('/{id}', [ShopHourController::class, 'update']);
    Route::delete('/{id}', [ShopHourController::class, 'delete']);
});

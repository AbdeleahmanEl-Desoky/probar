<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\ScheduleShop\Controllers\ScheduleShopController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/most-selling-services', [ScheduleShopController::class, 'mostSellingServices']);
    Route::get('/rate', [ScheduleShopController::class, 'rate']);
    Route::get('/total-earning', [ScheduleShopController::class, 'totalEarning']);

    Route::post('/', [ScheduleShopController::class, 'store']);
    Route::get('/{id}', [ScheduleShopController::class, 'show']);
    Route::put('/{id}', [ScheduleShopController::class, 'update']);
    Route::delete('/{id}', [ScheduleShopController::class, 'delete']);
});

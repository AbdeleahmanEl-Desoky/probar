<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\ScheduleShop\Controllers\ScheduleShopController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/most-selling-services', [ScheduleShopController::class, 'mostSellingServices']);
    Route::get('/rate', [ScheduleShopController::class, 'rate']);
    Route::get('/total-earning', [ScheduleShopController::class, 'totalEarning']);
    Route::get('/booking', [ScheduleShopController::class, 'booking']);

    Route::get('/booking/{id}', [ScheduleShopController::class, 'showBookong']);
    Route::get('/booking/{id}/checkout', [ScheduleShopController::class, 'checkout']);

    Route::put('/booking/{id}/status', [ScheduleShopController::class, 'statusBooking']);

    Route::put('/booking/{id}/payments', [ScheduleShopController::class, 'paymentsBooking']);
});

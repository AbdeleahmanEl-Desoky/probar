<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Schedule\Controllers\ScheduleController;

Route::group(['middleware' => ['auth:api_clients']], function () {
    Route::get('shops/{shop_id}', [ScheduleController::class, 'index']);
    Route::get('/', [ScheduleController::class, 'clientIndex']);
    Route::post('/', [ScheduleController::class, 'store']);
    Route::post('/details', [ScheduleController::class, 'getData']);

});

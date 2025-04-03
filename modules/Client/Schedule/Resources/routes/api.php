<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Schedule\Controllers\ScheduleController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', [ScheduleController::class, 'index']);
    Route::post('/', [ScheduleController::class, 'store']);
    Route::get('/{id}', [ScheduleController::class, 'show']);
    Route::put('/{id}', [ScheduleController::class, 'update']);
    Route::delete('/{id}', [ScheduleController::class, 'delete']);
});

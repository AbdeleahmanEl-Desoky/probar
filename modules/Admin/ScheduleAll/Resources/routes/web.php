<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ScheduleAll\Controllers\ScheduleAllController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ScheduleAllController::class, 'index']);
    Route::post('/', [ScheduleAllController::class, 'store']);
    Route::get('/{id}', [ScheduleAllController::class, 'show']);
    Route::put('/{id}', [ScheduleAllController::class, 'update']);
    Route::delete('/{id}', [ScheduleAllController::class, 'delete']);
});

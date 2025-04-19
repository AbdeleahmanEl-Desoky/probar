<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\ReportBarber\Controllers\ReportBarberController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [ReportBarberController::class, 'index']);
    Route::post('/', [ReportBarberController::class, 'store']);
    Route::get('/{id}', [ReportBarberController::class, 'show']);
    Route::put('/{id}', [ReportBarberController::class, 'update']);
    Route::delete('/{id}', [ReportBarberController::class, 'delete']);
});

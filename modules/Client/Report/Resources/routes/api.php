<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Report\Controllers\ReportController;

Route::group(['middleware' => ['auth:api_clients']], function () {
    Route::get('/', [ReportController::class, 'index']);
    Route::post('/', [ReportController::class, 'store']);
    Route::get('/{id}', [ReportController::class, 'show']);
    Route::put('/{id}', [ReportController::class, 'update']);
    Route::delete('/{id}', [ReportController::class, 'delete']);
});

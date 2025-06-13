<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ReportAll\Controllers\ReportAllController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ReportAllController::class, 'index']);
    Route::post('/', [ReportAllController::class, 'store']);
    Route::get('/{id}', [ReportAllController::class, 'show']);
    Route::put('/{id}', [ReportAllController::class, 'update']);
    Route::delete('/{id}', [ReportAllController::class, 'delete']);
});

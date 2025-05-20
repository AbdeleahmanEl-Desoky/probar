<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Notification\Controllers\NotificationController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/', [NotificationController::class, 'store']);
    Route::get('/{id}', [NotificationController::class, 'show']);
    Route::put('/{id}', [NotificationController::class, 'update']);
    Route::delete('/{id}', [NotificationController::class, 'delete']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\AuthClient\Controllers\AuthClientController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [AuthClientController::class, 'index']);
    Route::post('/', [AuthClientController::class, 'store']);
    Route::get('/{id}', [AuthClientController::class, 'show']);
    Route::put('/{id}', [AuthClientController::class, 'update']);
    Route::delete('/{id}', [AuthClientController::class, 'delete']);
});

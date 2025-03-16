<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\AuthAdmin\Controllers\AuthAdminController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', [AuthAdminController::class, 'index']);
    Route::post('/', [AuthAdminController::class, 'store']);
    Route::get('/{id}', [AuthAdminController::class, 'show']);
    Route::put('/{id}', [AuthAdminController::class, 'update']);
    Route::delete('/{id}', [AuthAdminController::class, 'delete']);
});

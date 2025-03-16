<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\CoreAdmin\Controllers\CoreAdminController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', [CoreAdminController::class, 'index']);
    Route::post('/', [CoreAdminController::class, 'store']);
    Route::get('/{id}', [CoreAdminController::class, 'show']);
    Route::put('/{id}', [CoreAdminController::class, 'update']);
    Route::delete('/{id}', [CoreAdminController::class, 'delete']);
});

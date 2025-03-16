<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\CoreClient\Controllers\CoreClientController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', [CoreClientController::class, 'index']);
    Route::post('/', [CoreClientController::class, 'store']);
    Route::get('/{id}', [CoreClientController::class, 'show']);
    Route::put('/{id}', [CoreClientController::class, 'update']);
    Route::delete('/{id}', [CoreClientController::class, 'delete']);
});

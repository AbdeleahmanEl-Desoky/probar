<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\Shop\Controllers\ShopController;

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', [ShopController::class, 'index']);
    Route::post('/', [ShopController::class, 'store']);
    Route::get('/{id}', [ShopController::class, 'show']);
    Route::put('/{id}', [ShopController::class, 'update']);
    Route::delete('/{id}', [ShopController::class, 'delete']);
});

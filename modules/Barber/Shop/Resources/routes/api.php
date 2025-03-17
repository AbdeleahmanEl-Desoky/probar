<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\Shop\Controllers\ShopController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [ShopController::class, 'show']);
    Route::post('/', [ShopController::class, 'store']);
    Route::put('/{id}', [ShopController::class, 'update']);
    Route::delete('/{id}', [ShopController::class, 'delete']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\Shop\Controllers\ShopController;

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [ShopController::class, 'show']);
    Route::post('/', [ShopController::class, 'store']);
    Route::put('/map', [ShopController::class, 'update']);
    Route::delete('/{id}', [ShopController::class, 'delete']);
    Route::post('/update-status', [ShopController::class, 'updateShopStatus']);
    Route::post('/update-shop-hold', [ShopController::class, 'updateShopHold']);
});

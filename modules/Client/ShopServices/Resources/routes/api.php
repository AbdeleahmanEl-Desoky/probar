<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\ShopServices\Controllers\ShopServicesController;

Route::group(['middleware' => ['auth:api_clients']], function () {
    Route::get('/shops/{shop_id}', [ShopServicesController::class, 'index']);
});

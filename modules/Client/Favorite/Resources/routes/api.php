<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Favorite\Controllers\FavoriteController;

Route::group(['middleware' => ['auth:api_clients']], function () {
    Route::get('/', [FavoriteController::class, 'index']);
    Route::post('/', [FavoriteController::class, 'store']);
});

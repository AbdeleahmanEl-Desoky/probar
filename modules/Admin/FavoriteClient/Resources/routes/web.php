<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\FavoriteClient\Controllers\FavoriteClientController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [FavoriteClientController::class, 'index'])->name('index');
    Route::post('/', [FavoriteClientController::class, 'store']);
    Route::get('/{id}', [FavoriteClientController::class, 'show']);
    Route::put('/{id}', [FavoriteClientController::class, 'update']);
    Route::delete('/{id}', [FavoriteClientController::class, 'delete']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ShopBarber\Controllers\ShopBarberController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ShopBarberController::class, 'index'])->name('index');
    Route::post('/{id}/toggle-featured', [ShopBarberController::class, 'toggleFeatured'])->name('toggleFeatured');

    Route::post('/', [ShopBarberController::class, 'store']);
    Route::get('/{id}', [ShopBarberController::class, 'show']);
    Route::put('/{id}', [ShopBarberController::class, 'update']);
    Route::delete('/{id}', [ShopBarberController::class, 'delete']);
});

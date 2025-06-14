<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Barber\Controllers\BarberController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [BarberController::class, 'index'])->name('index');
    Route::put('/{id}', [BarberController::class, 'update']);
    Route::post('{id}/toggle-status', [BarberController::class, 'toggleStatus'])->name('toggle-status');

});

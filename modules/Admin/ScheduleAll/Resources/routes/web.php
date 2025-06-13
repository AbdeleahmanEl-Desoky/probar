<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ScheduleAll\Controllers\ScheduleAllController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ScheduleAllController::class, 'index'])->name('index');
    Route::post('/', [ScheduleAllController::class, 'store'])->name('active');
    Route::get('/incoming', [ScheduleAllController::class, 'show'])->name('incoming');
    Route::put('/', [ScheduleAllController::class, 'update'])->name('history');
});

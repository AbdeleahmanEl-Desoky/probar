<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\ScheduleAll\Controllers\ScheduleAllController;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [ScheduleAllController::class, 'index'])->name('index');
});

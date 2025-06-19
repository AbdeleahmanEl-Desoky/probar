<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\CoreAdmin\Controllers\AuthController;
use Modules\Admin\CoreAdmin\Controllers\CoreAdminController;


Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.post');

// Authenticated routes (require admin login)
Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    // We will create this controller and view next
    Route::get('/', [CoreAdminController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

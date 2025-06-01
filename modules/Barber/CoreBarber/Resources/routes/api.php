<?php

use Illuminate\Support\Facades\Route;
use Modules\Barber\CoreBarber\Controllers\CoreBarberController;

Route::post('/register', [CoreBarberController::class, 'register']);
Route::post('/login', [CoreBarberController::class, 'login']);
Route::post('forgot-password', [CoreBarberController::class, 'forgotPassword']);
Route::post('reset-password', [CoreBarberController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:api_barbers']], function () {
    Route::get('/', [CoreBarberController::class, 'me']);
    Route::put('/', [CoreBarberController::class, 'update']);
    Route::delete('/{id}', [CoreBarberController::class, 'delete']);
});

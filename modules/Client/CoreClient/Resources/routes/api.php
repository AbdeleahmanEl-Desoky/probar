<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\CoreClient\Controllers\CoreClientController;


Route::post('/register', [CoreClientController::class, 'register']);
Route::post('/login', [CoreClientController::class, 'login']);
Route::post('forgot-password', [CoreClientController::class, 'forgotPassword']);
Route::post('reset-password', [CoreClientController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:api_clients']], function () {
    Route::get('/', [CoreClientController::class, 'me']);
    Route::post('/', [CoreClientController::class, 'update']);
});

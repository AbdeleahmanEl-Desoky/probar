<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Help\Controllers\HelpController;


    Route::post('/', [HelpController::class, 'store']);


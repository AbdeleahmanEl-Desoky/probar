<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Media\Controllers\MediaController;

    Route::delete('/{ids}', [MediaController::class, 'delete']);


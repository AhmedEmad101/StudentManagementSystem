<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\StudentController;

Route::middleware('auth:sanctum')
    ->prefix('student')
    ->group(function () {
        Route::get('/me', [StudentController::class, 'me']);//todo 
    });

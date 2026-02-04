<?php

use App\Http\Controllers\Api\v1\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('student')
    ->group(function () {
        Route::get('/me', [StudentController::class, 'me']); // todo
    });

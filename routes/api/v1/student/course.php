<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CourseController;

Route::middleware('auth:sanctum')
    ->prefix('student/courses')
    ->group(function () {

        Route::get('/', [CourseController::class, 'index']);
    });

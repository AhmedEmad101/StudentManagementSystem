<?php

use App\Http\Controllers\Api\v1\CourseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('student/courses')
    ->group(function () {

        Route::get('/', [CourseController::class, 'index']);
    });

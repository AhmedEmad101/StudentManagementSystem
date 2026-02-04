<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\GradeController;

Route::middleware('auth:sanctum')
    ->prefix('student/grades')
    ->group(function () {

        Route::get('/', [GradeController::class, 'index']);
    });

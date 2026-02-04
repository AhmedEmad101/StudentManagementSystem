<?php

use App\Http\Controllers\Api\v1\GradeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->prefix('student/grades')
    ->group(function () {

        Route::get('/', [GradeController::class, 'index']);
    });

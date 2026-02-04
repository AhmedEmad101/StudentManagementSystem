<?php

use App\Http\Controllers\Api\v1\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin/students')
    ->group(function () {

        Route::get('/', [StudentController::class, 'index']);
        Route::get('/filter', [StudentController::class, 'filter']);
        Route::get('/{student}', [StudentController::class, 'show']);
        Route::post('/', [StudentController::class, 'store']);
        Route::put('/{student}', [StudentController::class, 'update']);
        Route::delete('/{student}', [StudentController::class, 'destroy']);
    });

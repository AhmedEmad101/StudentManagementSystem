<?php

use App\Http\Controllers\Api\v1\GradeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::prefix('grades')->group(function () {
            Route::get('/', [GradeController::class, 'index']);
            Route::post('/', [GradeController::class, 'store']);
            Route::put('/{grade}', [GradeController::class, 'update']);
            Route::delete('/{grade}', [GradeController::class, 'destroy']);
        });
    });

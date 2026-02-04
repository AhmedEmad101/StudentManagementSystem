<?php

use App\Http\Controllers\Api\v1\GradeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])
    ->prefix('api/v1/')
    ->name('admin.')
    ->group(function () {
        Route::prefix('grades')->group(function () {
            Route::post('/', [GradeController::class, 'store']);
            Route::put('/{grade}', [GradeController::class, 'update']);
            Route::delete('/{grade}', [GradeController::class, 'destroy']);
        });
    });

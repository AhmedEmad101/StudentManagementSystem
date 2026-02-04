<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GradeController;
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
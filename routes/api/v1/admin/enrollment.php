<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EnrollmentController;

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin/enrollments')
    ->group(function () {

        Route::post('/', [EnrollmentController::class, 'store']);
        Route::delete('/{id}', [EnrollmentController::class, 'destroy']);
    });

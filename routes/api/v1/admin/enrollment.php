<?php

use App\Http\Controllers\Api\v1\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin/enrollments')
    ->group(function () {

        Route::post('/', [EnrollmentController::class, 'store']);
        Route::delete('/{id}', [EnrollmentController::class, 'destroy']);
    });

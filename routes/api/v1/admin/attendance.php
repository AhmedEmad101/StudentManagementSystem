<?php

use App\Http\Controllers\Api\v1\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin/attendance')
    ->group(function () {
        Route::get('/', [AttendanceController::class, 'index']);
        Route::get('/students/{student}', [AttendanceController::class, 'index']);
    });

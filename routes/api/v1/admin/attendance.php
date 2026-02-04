<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin/attendance')
    ->group(function () {
        Route::get('/', [AttendanceController::class, 'index']);
        Route::get('/students/{student}', [AttendanceController::class, 'index']);
    });

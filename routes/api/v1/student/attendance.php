<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AttendanceController;
Route::middleware(['auth:sanctum'])
    ->name('student.')
    ->prefix('student/attendance')
    ->group(function () {
       
           Route::get('/{attendance}', [AttendanceController::class, 'show']);
           Route::post('/check-in', [AttendanceController::class, 'check_in']);
           Route::post('/check-out/{attendance}', [AttendanceController::class, 'check_out']);
  });
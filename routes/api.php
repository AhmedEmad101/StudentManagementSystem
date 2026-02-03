<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login_execption'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('students')->group(function () {
       Route::get('/', [StudentController::class, 'index'])->name('students.index');
         Route::get('/filter', [StudentController::class, 'filter'])->name('students.filter');
          Route::get('{student}', [StudentController::class, 'show'])->name('students.show');
          Route::post('/', [StudentController::class, 'store'])->name('students.store');
          Route::put('{student}', [StudentController::class, 'update'])->name('students.update');
          Route::delete('{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        
    });
    Route::prefix('courses')->group(function () {
          Route::get('/', [CourseController::class, 'index']);
          Route::get('/{course}', [CourseController::class, 'show']);
          Route::post('/', [CourseController::class, 'store']);
          Route::put('/{course}', [CourseController::class, 'update']);
          Route::delete('/{course}', [CourseController::class, 'destroy']);

    });
    Route::prefix('grades')->group(function () {
    Route::get('/', [GradeController::class, 'index']);
    Route::get('/{grade}', [GradeController::class, 'show']);
    Route::post('/', [GradeController::class, 'store']);
    Route::put('/{grade}', [GradeController::class, 'update']);
    Route::delete('/{grade}', [GradeController::class, 'destroy']);

    });
    Route::prefix('enrollments')->group(function () {
         Route::post('/', [EnrollmentController::class, 'store']);
          Route::delete('/{id}', [EnrollmentController::class, 'destroy']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

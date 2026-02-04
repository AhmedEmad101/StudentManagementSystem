<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;



Route::prefix('v1')->group(function () {
     require __DIR__ . '/api/v1/auth.php';
    require __DIR__ . '/api/v1/admin.php';
    require __DIR__ . '/api/v1/student.php';        
});

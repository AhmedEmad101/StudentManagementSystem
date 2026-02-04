<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\Login;
use App\Actions\Auth\Register;
use App\Actions\Auth\Logout;
use App\DTOs\CreateStudentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request, Login $loginAction)
    {
        try {
            $data = $request->validated();
            $token = $loginAction->execute($data['email'], $data['password']);

            if (! $token) {
                return $this->errorResponse('Invalid credentials', 401);
            }

            return $this->successResponse([
                'token' => $token,
                'user' => auth()->user(),
            ], 'Login successful!');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function register(StoreStudentRequest $request,Register $register_student)
    {
       $student = $register_student->execute(CreateStudentDTO::fromRequest($request));
        return $this->successResponse(new StudentResource($student), 'you created your account successfully', 201);
    }

    public function logout(Request $request)
    {
        try {
            (new Logout)->execute($request);

            return $this->successResponse(null, 'Logged out successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function login_execption(Request $request)
    {
        return $this->errorResponse('you have to login', 401);
    }
}

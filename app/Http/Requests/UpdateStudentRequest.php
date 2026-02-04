<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public function rules(): array
    {
        $studentId = $this->route('student')->id;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$studentId,
            'phone' => 'required|unique:users,phone,'.$studentId,
            'password' => 'nullable|string|min:6',
            'status' => 'sometimes|in:active,inactive',
        ];
    }
}

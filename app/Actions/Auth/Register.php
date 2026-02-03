<?php

namespace App\Actions\Auth;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class Register
{
    public function execute(array $data): Student
    {
        return Student::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'password' => Hash::make($data['password']),
            'status'   => 'active',
        ]);
    }
}

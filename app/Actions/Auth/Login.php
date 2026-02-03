<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class login
{
    public function execute(string $email, string $password)
    {
        if (! Auth::attempt(['email' => $email, 'password' => $password])) {
            abort(401, 'Invalid credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $token;
    }
}

<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function execute(array $userData)
    {
        return DB::transaction(function () use ($userData) {

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);

            if (! empty($userData['roles'])) {
                $user->syncRoles($userData['roles']);
            }

            return $user;
        });
    }
}

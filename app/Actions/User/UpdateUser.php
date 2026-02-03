<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    public function execute(User $user, array $userData): User
    {
        return DB::transaction(function () use ($user, $userData) {

            $user->update([
                'name' => $userData['name'],
                'email' => $userData['email'],
            ]);
            if (! empty($userData['password'])) {
                $user->update([
                    'password' => Hash::make($userData['password']),
                ]);
            }

            if (! empty($userData['roles'])) {
                $user->syncRoles($userData['roles']);
            }

            return $user;
        });
    }
}

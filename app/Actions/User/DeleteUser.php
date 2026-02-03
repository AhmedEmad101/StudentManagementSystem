<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteUser
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            $user->roles()->detach();
            $user->delete();
        });
    }
}

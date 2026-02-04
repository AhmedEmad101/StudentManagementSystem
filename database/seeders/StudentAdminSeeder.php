<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StudentAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Student',
            'email' => 'admin@example.com',
            'phone' => '01100000000',
            'password' => 123456,
            'status' => 'active',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'user Student',
            'email' => 'user@example.com',
            'phone' => '01000000000',
            'password' => 123456,
            'status' => 'active',
            'role' => 'student',
        ]);
        User::factory()->count(20)->create();
    }
}

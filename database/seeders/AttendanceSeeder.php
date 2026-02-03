<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['present', 'late', 'absent'];

        foreach (User::all() as $student) {
            for ($i = 1; $i <= 10; $i++) {
                $status = $statuses[array_rand($statuses)];

                Attendance::create([
                    'user_id' => $student->id,
                    'date' => now()->subDays($i),
                    'check_in_at' => $status !== 'absent' ? '09:00:00' : null,
                    'check_out_at' => $status !== 'absent' ? '14:00:00' : null,
                    'status' => $status,
                ]);
            }
        }
    }
}

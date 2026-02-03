<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = ['A', 'B', 'C', 'D'];

        foreach (Enrollment::all() as $enrollment) {
            Grade::create([
                'user_id' => $enrollment->user_id,
                'course_id' => $enrollment->course_id,
                'grade_value' => rand(0, 1)
                    ? rand(60, 100)
                    : $grades[array_rand($grades)],
                'notes' => 'Auto generated grade',
            ]);
        }
    }
}

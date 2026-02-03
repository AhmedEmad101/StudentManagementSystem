<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('role','student')->get();
        $courses = Course::all();

        foreach ($students as $student) {
            $studentCourses = $courses->random(rand(1, 3));

            foreach ($studentCourses as $course) {
                Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'enrolled_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}

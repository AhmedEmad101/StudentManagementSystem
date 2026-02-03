<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::insert([
            [
                'title' => 'Laravel Backend',
                'code' => 'LAR101',
                'description' => 'Laravel fundamentals',
                'hours' => 40,
                'created_at' => now(),
            ],
            [
                'title' => 'Advanced PHP',
                'code' => 'PHP201',
                'description' => 'OOP, SOLID, Patterns',
                'hours' => 30,
                'created_at' => now(),
            ],
            [
                'title' => 'Database Design',
                'code' => 'DB301',
                'description' => 'SQL & normalization',
                'hours' => 25,
                'created_at' => now(),
            ],
        ]);
    }
}

<?php
use App\Models\Student;
use App\Models\User;
use App\Models\Grade;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Actions\Grade\ShowGrade;
use Mockery\Matcher\Any;

use function PHPUnit\Framework\assertEquals;

uses(
    Tests\TestCase::class,
    RefreshDatabase::class
);
it('can create a student by admin', function () {
   $admin = User::factory()->admin()->create();

$this->actingAs($admin, 'sanctum')
    ->postJson('/api/v1/admin/students', [
        'name' => 'Ahmed',
        'email' => 'ahmed@example.com',
        'phone'=>'0123456789',
        'password' => '123456',
    ])
    ->assertStatus(201);
});
it('can show student\'s courses', function () {
   $student = User::factory()->create();
$this->actingAs($student, 'sanctum')
    ->getJson('/api/v1/student/courses/')
    ->assertStatus(200);
});



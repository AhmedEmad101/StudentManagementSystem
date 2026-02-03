<?php

namespace App\Actions\Course;

use App\DTOs\UpdateCourseDTO;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\DB;

class UpdateCourse
{
    public function __construct(protected CourseRepository $courseRepository) {}

    public function execute(Course $course, UpdateCourseDTO $dto): Course
    {
        return DB::transaction(function () use ($course, $dto) {

            $updatedCourse = $this->courseRepository->update($course->id, $dto->course_data);

            return $updatedCourse;
        });
    }
}

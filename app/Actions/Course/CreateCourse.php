<?php

namespace App\Actions\Course;

use App\DTOs\CreateCourseDTO;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\DB;

class CreateCourse
{
    public function __construct(protected CourseRepository $courseRepository) {}

    public function execute(CreateCourseDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $course = $this->courseRepository->store([
                'title' => $dto->title,
                'code' => $dto->code,
                'description' => $dto->description,
                'hours' => $dto->hours,
            ]);

            return $course;
        });
    }
}

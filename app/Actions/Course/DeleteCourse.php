<?php

namespace App\Actions\Course;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class DeleteCourse
{
    public function __construct(
        protected CourseRepository $courseRepository
    ) {}

    public function execute(Course $course): void
    {
        DB::transaction(function () use ($course) {

            // Admin-only authorization
            if (auth()->user()->role !== 'admin') {
                throw new AuthorizationException('Only admins can delete courses.');
            }

            $this->courseRepository->delete($course->id);
        });
    }
}

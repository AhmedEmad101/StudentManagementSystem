<?php

namespace App\Http\Controllers\Api;

use App\Actions\Course\CreateCourse;
use App\Actions\Course\UpdateCourse;
use App\Actions\Course\DeleteCourse;
use App\DTOs\CreateCourseDTO;
use App\DTOs\UpdateCourseDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Traits\ApiResponseTrait;

class CourseController extends Controller
{
    use ApiResponseTrait;

    public function index(CourseRepository $courseRepository)
    {
        $courses = $courseRepository->index(['grades'],10);
        return $this->successResponse(CourseResource::collection($courses));
    }

    public function show(Course $course)
    {
        return $this->successResponse(new CourseResource($course));
    }

    public function store(StoreCourseRequest $request, CreateCourse $createCourse)
    {
        $course = $createCourse->execute(CreateCourseDTO::fromRequest($request));
        return $this->successResponse(new CourseResource($course), 'Course created successfully', 201);
    }

    public function update(UpdateCourseRequest $request, Course $course, UpdateCourse $updateCourse)
    {
        $updated_course = $updateCourse->execute($course, UpdateCourseDTO::fromRequest($request));
        return $this->successResponse(new CourseResource($updated_course), 'Course updated successfully', 200);
    }

    public function destroy(Course $course, DeleteCourse $deleteCourse)
    {
        $deleteCourse->execute($course);
        return $this->successResponse([], 'Course deleted successfully', 204);
    }
}

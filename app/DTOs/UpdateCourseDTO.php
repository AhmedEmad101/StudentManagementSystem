<?php

namespace App\DTOs;

use App\Http\Requests\UpdateCourseRequest;

class UpdateCourseDTO
{
    public array $course_data;

    public function __construct(array $course_data)
    {
        $this->course_data = $course_data;
    }

    public static function fromRequest(UpdateCourseRequest $request): self
    {
        return new self($request->validated());
    }
}

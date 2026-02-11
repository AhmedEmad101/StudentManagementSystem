<?php

namespace App\DTOs;

use App\Http\Requests\FilterGradeRequest;

class GradeFilterDTO
{
    public function __construct(
        public readonly ?int $user_id,
        public readonly ?int $course_id,
    ) {}
    public static function fromRequest(FilterGradeRequest $request): self
    {
        $data = $request->validated();

        return new self(
            $data['user_id'] ?? null,
           $data['course_id'] ?? null,
        );
    }
}

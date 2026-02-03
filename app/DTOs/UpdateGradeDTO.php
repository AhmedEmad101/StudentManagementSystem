<?php

namespace App\DTOs;

use App\Http\Requests\UpdateGradeRequest;

class UpdateGradeDTO
{
    public function __construct(
        public int $user_id,
        public int $course_id,
        public string|int $grade_value,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(UpdateGradeRequest $request): self
    {
        return new self(
            $request->user_id,
            $request->course_id,
            $request->grade_value,
            $request->notes
        );
    }
}

<?php

namespace App\Filters\Grade;

use App\DTOs\GradeFilterDTO;
use App\Interfaces\GradeFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CourseFilter implements GradeFilterInterface
{
    public function apply(Builder $query, GradeFilterDTO $dto): void
    {
        if (! $dto->course_id) {
            return;
        }
            $query->where('course_id', $dto->course_id);
    }
}

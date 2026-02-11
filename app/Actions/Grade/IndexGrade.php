<?php

namespace App\Actions\Grade;

use App\DTOs\GradeFilterDTO;
use App\Filters\Grade\StudentFilter;
use App\Filters\Grade\CourseFilter;
use App\Filters\Grade\GradeFilterExecuter;
use App\Models\Grade;

class IndexGrade
{
    public function execute(GradeFilterDTO $grade_dto, int $pagination = 5)
    {
        $query = Grade::query()
            ->with(['course', 'student']);

        $filters = new GradeFilterExecuter([
            new StudentFilter,
            new CourseFilter,
        ]);

        $filters->apply($query, $grade_dto);

        return $query
            ->orderByDesc('created_at')
            ->paginate($pagination);
    }
}

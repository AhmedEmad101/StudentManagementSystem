<?php

namespace App\Actions\Grade;

use App\DTOs\GradeFilterDTO;
use App\Filters\Grade\StudentFilter;
use App\Filters\Grade\CourseFilter;
use App\Filters\Grade\GradeFilterExecuter;
use App\Models\Grade;
use App\Repositories\GradeRepository;
class IndexGrade
{public function __construct(protected GradeRepository $gradeRepository) {}
    public function execute(GradeFilterDTO $grade_dto, int $pagination = 5)
    {
          $query = $this->gradeRepository->index(['student', 'course'],$pagination)->getCollection()->toQuery();

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

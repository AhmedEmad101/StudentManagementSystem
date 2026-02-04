<?php

namespace App\Actions\Student;

use App\DTOs\StudentFilterDTO;
use App\Filters\Student\SearchFilter;
use App\Filters\Student\StatusFilter;
use App\Filters\Student\StudentFilterExecuter;
use App\Models\User;

class FilterStudents
{
    public function execute(StudentFilterDTO $student_dto, int $pagination = 5)
    {
        $query = User::query()
            ->where('role', 'student');

        $filters = new StudentFilterExecuter([
            new SearchFilter,
            new StatusFilter,
        ]);

        $filters->apply($query, $student_dto);

        return $query
            ->orderByDesc('created_at')
            ->paginate($pagination);
    }
}

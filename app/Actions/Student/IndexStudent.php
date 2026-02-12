<?php

namespace App\Actions\Student;

use App\DTOs\StudentFilterDTO;
use App\Filters\Student\SearchFilter;
use App\Filters\Student\StatusFilter;
use App\Filters\Student\StudentFilterExecuter;
use App\Models\User;
use App\Repositories\StudentRepository;

class IndexStudent
{public function __construct(protected StudentRepository $student_repository) {}
    public function execute(StudentFilterDTO $student_dto, int $pagination = 5)
    {
        $query = $this->student_repository->index(['grade'], $pagination)->getCollection()->toQuery();

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

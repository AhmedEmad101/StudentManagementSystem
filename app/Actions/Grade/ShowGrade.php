<?php

namespace App\Actions\Grade;

use App\Models\Grade;
use App\Repositories\GradeRepository;

class ShowGrade
{
    public function __construct(protected GradeRepository $gradeRepository) {}

    public function execute(Grade $grade)
    {
        $grade = $this->gradeRepository->show($grade->id);

        return $grade;
    }
}

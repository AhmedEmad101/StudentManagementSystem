<?php

namespace App\Actions\Student;

use App\Models\User;;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;

class ShowStudent
{
    public function __construct(protected StudentRepository $student_repository) {}

    public function execute(User $student)
    {
        $student = $this->student_repository->show($student->id);

        return $student;
    }
}

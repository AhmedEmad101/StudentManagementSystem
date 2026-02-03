<?php

namespace App\Actions\Grade;

use App\DTOs\CreateGradeDTO;
use App\Repositories\GradeRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Enrollment;
use Illuminate\Validation\ValidationException;
class CreateGrade
{
    public function __construct(protected GradeRepository $gradeRepository) {}

    public function execute(CreateGradeDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
             $isEnrolled = Enrollment::where('student_id', $dto->user_id)
                ->where('course_id', $dto->course_id)
                ->exists();
                 if (! $isEnrolled) {
                throw ValidationException::withMessages([
                    'course_id' => 'Student is not enrolled in this course.'
                ]);
            }
            return $this->gradeRepository->store([
                'user_id' => $dto->user_id,
                'course_id' => $dto->course_id,
                'grade_value' => $dto->grade_value,
                'notes' => $dto->notes,
            ]);
        });
    }
}

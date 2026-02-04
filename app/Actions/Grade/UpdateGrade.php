<?php

namespace App\Actions\Grade;

use App\DTOs\UpdateGradeDTO;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Repositories\GradeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateGrade
{
    public function __construct(protected GradeRepository $gradeRepository) {}

    public function execute(Grade $grade, UpdateGradeDTO $dto): Grade
    {
        return DB::transaction(function () use ($grade, $dto) {
            $isEnrolled = Enrollment::where('student_id', $dto->user_id)
                ->where('course_id', $dto->course_id)
                ->exists();
            if (! $isEnrolled) {
                throw ValidationException::withMessages([
                    'course_id' => 'Student is not enrolled in this course.',
                ]);
            }

            return $this->gradeRepository->update($grade->id, [
                'user_id' => $dto->user_id,
                'course_id' => $dto->course_id,
                'grade_value' => $dto->grade_value,
                'notes' => $dto->notes,
            ]);
        });
    }
}

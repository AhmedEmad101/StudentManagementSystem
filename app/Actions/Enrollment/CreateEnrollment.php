<?php

namespace App\Actions\Enrollment;

use App\Models\Enrollment;
use Illuminate\Validation\ValidationException;

class CreateEnrollment
{
    public function execute(int $studentId, int $courseId): Enrollment
    {
        $exists = Enrollment::where('user_id', $studentId)
            ->where('course_id', $courseId)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'enrollment' => 'Student already enrolled in this course',
            ]);
        }

        return Enrollment::create([
            'user_id' => $studentId,
            'course_id'  => $courseId,
            'enrolled_at'=> now(),
        ]);
    }
}

<?php

namespace App\Actions\Enrollment;

use App\Models\Enrollment;

class DeleteEnrollment
{
    public function execute(int $id): void
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
    }
}

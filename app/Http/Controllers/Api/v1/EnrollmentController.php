<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Enrollment\CreateEnrollment;
use App\Actions\Enrollment\DeleteEnrollment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    use ApiResponseTrait;

    public function store(
        StoreEnrollmentRequest $request,
        CreateEnrollment $createEnrollment
    ) {
        try {
            $enrollment = $createEnrollment->execute(
                $request->student_id,
                $request->course_id
            );

            return $this->successResponse(
                $enrollment,
                'Student enrolled successfully',
                201
            );
        } catch (ValidationException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                422,
                $e->errors()
            );
        }
    }

    public function destroy(
        int $id,
        DeleteEnrollment $deleteEnrollment
    ) {
        $deleteEnrollment->execute($id);

        return $this->successResponse(
            null,
            'Enrollment deleted successfully',
            204
        );
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Student\CreateStudent;
use App\Actions\Student\DeleteStudent;
use App\Actions\Student\ShowStudent;
use App\Actions\Student\IndexStudent;
use App\Actions\Student\UpdateStudent;
use App\DTOs\CreateStudentDTO;
use App\DTOs\StudentFilterDTO;
use App\DTOs\UpdateStudentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\User;
use App\Repositories\StudentRepository;
use App\Traits\ApiResponseTrait;

class StudentController extends Controller
{
    use ApiResponseTrait;

    public function index(IndexStudent $student,FilterStudentRequest $request)
    {
        $students = $student->execute(StudentFilterDTO::fromRequest($request), 10);
        return $this->successResponse(StudentResource::collection($students));
    }

    public function show(User $student, ShowStudent $show_student)
    {    $student_data = $show_student->execute($student);
        return $this->successResponse(new StudentResource($student_data));
    }

    public function store(StoreStudentRequest $request, CreateStudent $createStudent)
    {
        $student = $createStudent->execute(CreateStudentDTO::fromRequest($request));

        return $this->successResponse(new StudentResource($student), 'Student created successfully', 201);
    }

    public function update(UpdateStudentRequest $request, User $student, UpdateStudent $updateStudent)
    {
        $updated_student = $updateStudent->execute($student, UpdateStudentDTO::fromRequest($request));

        return $this->successResponse(new StudentResource($updated_student), 'Student updated successfully', 200);
    }

    public function destroy(User $student, DeleteStudent $deleteStudent)
    {
        $deleteStudent->execute($student);

        return $this->successResponse([], 'Student deleted successfully', 204);
    }

    public function filter(FilterStudentRequest $request, FilterStudents $filter_students)
    {
        $student_dto = StudentFilterDTO::fromRequest($request);
        $students = $filter_students->execute($student_dto, 10);

        return $this->successResponse(StudentResource::collection($students));
    }

    public function me()
    {
        $student = auth()->user();

        return $this->successResponse(new StudentResource($student));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Actions\Student\CreateStudent;
use App\Actions\Student\UpdateStudent;
use App\Actions\Student\DeleteStudent;
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
use App\Actions\Student\FilterStudents;

class StudentController extends Controller
{
    use ApiResponseTrait;

    public function index(StudentRepository $repository)
    {
        $students = $repository->index([], 10);
        return $this->successResponse(StudentResource::collection($students));
    }

    public function show(User $student)
    {
        return $this->successResponse(new StudentResource($student));
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
}

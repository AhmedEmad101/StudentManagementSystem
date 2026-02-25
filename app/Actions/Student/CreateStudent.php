<?php

namespace App\Actions\Student;

use App\DTOs\CreateStudentDTO;
use App\Jobs\SendStudentWelcomeEmail;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;

class CreateStudent
{
    public function __construct(protected StudentRepository $repository) {}

    public function execute(CreateStudentDTO $dto)
    {
       $student = $this->repository->store([
                'name' => $dto->name,
                'email' => $dto->email,
                'phone' => $dto->phone,
                'password' => $dto->password,
                'status' => $dto->status,
                'role' => 'student',
            ]);
        SendStudentWelcomeEmail::dispatch($student);
        return $student;
    }
}

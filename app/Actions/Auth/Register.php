<?php

namespace App\Actions\Auth;

use App\DTOs\CreateStudentDTO;
use App\Jobs\SendStudentWelcomeEmail;
use App\Repositories\StudentRepository;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;

class Register
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

<?php

namespace App\Actions\Student;

use App\DTOs\UpdateStudentDTO;
use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;

class UpdateStudent
{
    public function __construct(protected StudentRepository $repository) {}

    public function execute(User $student, UpdateStudentDTO $dto): User
    {
        return DB::transaction(function () use ($student, $dto) {
            return $this->repository->update($student, $dto->toArray());
        });
    }
}

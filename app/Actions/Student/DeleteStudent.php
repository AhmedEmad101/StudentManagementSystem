<?php

namespace App\Actions\Student;

use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class DeleteStudent
{
    public function __construct(protected StudentRepository $repository) {}

    public function execute(User $student): void
    {
        DB::transaction(function () use ($student) {
            if (auth()->user()?->role !== 'admin') {
                throw new AuthorizationException('Only admins can delete students.');
            }
            $this->repository->delete($student);
        });
    }
}

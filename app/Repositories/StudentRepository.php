<?php

namespace App\Repositories;

use App\Interfaces\StudentInterface;
use App\Models\User;

class StudentRepository implements StudentInterface
{
    public function index(array $relationships = [])
    {
        return User::with($relationships)->where('role', 'student');
    }

    public function show($id)
    {
       $user = User::with(['grades'])->where('id',$id)->firstOrFail();
       return $user;
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update(User $student, array $data)
    {
        $student->update($data);

        return $student;
    }

    public function delete(User $student): void
    {
        $student->delete();
    }
}

<?php

namespace App\Repositories;

use App\Interfaces\GradeInterface;
use App\Models\Grade;

class GradeRepository implements GradeInterface
{
    public function index(array $relationships = [], int $pagination = 10)
    {
        return Grade::with($relationships)->paginate($pagination);
    }

    public function show(int $id)
    {
        return Grade::with(['student', 'course'])->where('user_id',auth()->id())->findOrFail($id);
    }

    public function store(array $data)
    {
        return Grade::create($data);
    }

    public function update(int $id, array $data)
    {
        $grade = Grade::findOrFail($id);
        $grade->update($data);
        return $grade;
    }

    public function delete(int $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();
    }
}

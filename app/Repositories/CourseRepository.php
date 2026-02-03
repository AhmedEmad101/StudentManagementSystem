<?php

namespace App\Repositories;

use App\Interfaces\CourseInterface;
use App\Models\Course;

class CourseRepository implements CourseInterface
{
    public function index(array $relationships = [], int $pagination = 5)
    {
        return Course::with($relationships)->paginate($pagination);
    }

    public function show($id)
    {
        $course = Course::with([])->findOrFail($id);

        return $course;
    }

    public function store(array $data)
    {
        return Course::create($data);
    }

    public function update(int $id, array $data)
    {
        $task = Course::findOrFail($id);
        $task->update($data);

        return $task;
    }

    public function delete(int $id): void
    {
        $task = Course::findOrFail($id);
        $task->delete();
    }
}

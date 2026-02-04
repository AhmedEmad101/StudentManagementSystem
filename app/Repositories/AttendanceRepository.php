<?php

namespace App\Repositories;

use App\Interfaces\AttendanceInterface;
use App\Models\Attendance;

class AttendanceRepository implements AttendanceInterface
{
    public function index(array $relationships = [], int $pagination = 5)
    {
        return Attendance::with($relationships)->paginate($pagination);
    }

    public function show(int $id)
    {
        return Attendance::with(['student'])->findOrFail($id);
    }

    public function store(array $data)
    {
        return Attendance::create($data);
    }

    public function update(int $id, array $data)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($data);

        return $attendance;
    }

    public function delete(int $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
    }
}

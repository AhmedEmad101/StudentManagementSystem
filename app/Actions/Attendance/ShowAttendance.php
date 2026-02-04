<?php

namespace App\Actions\Attendance;

use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use Illuminate\Validation\ValidationException;

class ShowAttendance
{
    public function __construct(protected AttendanceRepository $attendance_repositorya) {}

    public function execute(Attendance $attendance)
    {
        if (! (auth()->user()->can('view', $attendance))) {
            throw ValidationException::withMessages([
                'autherization' => 'unautherized attendance view',
            ]);
        }
        $attendance_data = $this->attendance_repositorya->show($attendance->id);

        return $attendance_data;
    }
}

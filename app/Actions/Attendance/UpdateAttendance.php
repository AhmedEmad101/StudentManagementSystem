<?php

namespace App\Actions\Attendance;

use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateAttendance
{
    public function __construct(
        protected AttendanceRepository $attendance_repository
    ) {}

    public function execute(Attendance $attendance)
    {
         if ($attendance->user_id !== auth()->id() || auth()->user()->role != 'Admin') {
            abort(403);
        }

        return DB::transaction(function () use ($attendance) {

            if ($attendance->check_out_at) {
                throw ValidationException::withMessages([
                    'attendance' => 'You already checked out',
                ]);
            }

            return $this->attendance_repository->update(
                $attendance->id,
                [
                    'check_out_at' => now(),
                ]
            );
        });
    }
}

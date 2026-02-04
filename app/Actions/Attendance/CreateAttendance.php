<?php

namespace App\Actions\Attendance;

use App\Repositories\AttendanceRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateAttendance
{
    public function __construct(
        protected AttendanceRepository $attendance_repository
    ) {}

    public function execute()
    {
        return DB::transaction(function () {

            $user = auth()->user();
            $today = now()->toDateString();

            $already_check_in = $user->attendances()
                ->whereDate('date', $today)
                ->exists();

            if ($already_check_in) {
                throw ValidationException::withMessages([
                    'attendance' => 'You have already checked in today',
                ]);
            }

            return $this->attendance_repository->store([
                'user_id' => $user->id,
                'date' => $today,
                'check_in_at' => now(),
                'status' => now()->greaterThan(Carbon::today()->setTime(9, 0, 0)) ? 'late' : 'present',
            ]);
        });
    }
}

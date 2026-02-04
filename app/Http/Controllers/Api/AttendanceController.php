<?php

namespace App\Http\Controllers\Api;

use App\Actions\Attendance\CreateAttendance;
use App\Actions\Attendance\UpdateAttendance;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $query = auth()->user()
            ->attendances();
        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $attendances = $query->paginate(10);

        return $this->successResponse(AttendanceResource::collection($attendances));
    }
    public function check_in(CreateAttendance $create_attendance)
    {
        $attendance = $create_attendance->execute();

        return $this->successResponse(
            new AttendanceResource($attendance),
            'Checked in successfully',
            201
        );
    }
    public function check_out(Attendance $attendance, UpdateAttendance $update_attendance)
    {
        $updated = $update_attendance->execute($attendance);

        return $this->successResponse(
            new AttendanceResource($updated),
            'Checked out successfully'
        );
    }
}

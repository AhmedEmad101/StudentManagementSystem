<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Attendance\CreateAttendance;
use App\Actions\Attendance\IndexAttendance;
use App\Actions\Attendance\ShowAttendance;
use App\Actions\Attendance\UpdateAttendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use App\DTOs\AttendanceFilterDTO;
class AttendanceController extends Controller
{
    use ApiResponseTrait;

    public function index(IndexAttendance $index_attendance, FilterAttendanceRequest $request)
    {
        $attendances = $index_attendance->execute(AttendanceFilterDTO::fromRequest($request), 10);
        return $this->successResponse(AttendanceResource::collection($attendances));
    }

   public function show(Attendance $attendance, ShowAttendance $show_attendance)
    {
        $attendance = $show_attendance->execute($attendance);

        return $this->successResponse(new AttendanceResource($attendance));
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

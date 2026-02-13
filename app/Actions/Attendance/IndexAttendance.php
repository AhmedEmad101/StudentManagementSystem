<?php

namespace App\Actions\Attendance;

use App\DTOs\AttendanceFilterDTO;
use App\Filters\Attendance\AttendanceFilterExecuter;
use App\Filters\Attendance\DateFromFilter;
use App\Filters\Attendance\DateToFilter;
use App\Repositories\AttendanceRepository;

class IndexAttendance
{public function __construct(protected AttendanceRepository $attendance_repository) {}
    public function execute(AttendanceFilterDTO $attendance_filter_dto, int $pagination = 5)
    {
        $query = $this->attendance_repository->index(['student'], $pagination)->getCollection()->toQuery();

        $filters = new AttendanceFilterExecuter([
            new DateFromFilter,
            new DateToFilter,
        ]);

        $filters->apply($query, $attendance_filter_dto);

        return $query
            ->orderByDesc('created_at')
            ->paginate($pagination);
    }
}

<?php

namespace App\Filters\Attendance;

use App\DTOs\AttendanceFilterDTO;
use App\Interfaces\AttendanceFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class DateToFilter implements AttendanceFilterInterface
{
    public function apply(Builder $query, AttendanceFilterDTO $dto): void
    {
        if (! $dto->date_to) {
            return;
        }

        $query->whereDate('date', '<=', $dto->date_to);
    }
}

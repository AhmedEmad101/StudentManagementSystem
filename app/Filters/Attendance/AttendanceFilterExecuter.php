<?php

namespace App\Filters\Attendance;

use Illuminate\Database\Eloquent\Builder;

class AttendanceFilterExecuter
{
    public function __construct(
        protected array $filters
    ) {}

    public function apply(Builder $query, $dto): void
    {
        foreach ($this->filters as $filter) {
            $filter->apply($query, $dto);
        }
    }
}

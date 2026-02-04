<?php

namespace App\Interfaces;

use App\DTOs\AttendanceFilterDTO;
use Illuminate\Database\Eloquent\Builder;

interface AttendanceFilterInterface
{
    public function apply(Builder $query, AttendanceFilterDTO $dto): void;
}

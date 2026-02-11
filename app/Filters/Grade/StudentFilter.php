<?php

namespace App\Filters\Grade;

use App\DTOs\GradeFilterDTO;
use App\Interfaces\GradeFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class StudentFilter implements GradeFilterInterface
{
    public function apply(Builder $query, GradeFilterDTO $dto): void
    {
        if (! $dto->user_id) {
            return;
        }
            $query->where('user_id', $dto->user_id);
    }
}

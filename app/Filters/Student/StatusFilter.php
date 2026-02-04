<?php

namespace App\Filters\Student;

use App\DTOs\StudentFilterDTO;
use App\Interfaces\StudentFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter implements StudentFilterInterface
{
    public function apply(Builder $query, StudentFilterDTO $dto): void
    {
        if (! $dto->status) {
            return;
        }

        $query->where('status', $dto->status);
    }
}

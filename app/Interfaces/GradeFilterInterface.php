<?php

namespace App\Interfaces;

use App\DTOs\GradeFilterDTO;
use Illuminate\Database\Eloquent\Builder;

interface GradeFilterInterface
{
    public function apply(Builder $query, GradeFilterDTO $dto): void;
}

<?php

namespace App\Interfaces;

use App\DTOs\StudentFilterDTO;
use Illuminate\Database\Eloquent\Builder;

interface StudentFilterInterface
{
    public function apply(Builder $query, StudentFilterDTO $dto): void;
}

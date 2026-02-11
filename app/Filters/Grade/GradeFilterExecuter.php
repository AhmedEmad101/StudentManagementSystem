<?php

namespace App\Filters\Grade;

use Illuminate\Database\Eloquent\Builder;

class GradeFilterExecuter
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

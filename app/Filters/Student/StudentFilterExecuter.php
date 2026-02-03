<?php
namespace App\Filters\Student;
use Illuminate\Database\Eloquent\Builder;

class StudentFilterExecuter
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
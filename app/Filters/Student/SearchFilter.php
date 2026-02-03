<?php
namespace App\Filters\Student;

use App\Interfaces\StudentFilterInterface;
use App\DTOs\StudentFilterDTO;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements StudentFilterInterface
{
    public function apply(Builder $query, StudentFilterDTO $dto): void
    {
        if (! $dto->search) {
            return;
        }

        $query->where(function ($q) use ($dto) {
            $q->where('name', 'like', "%{$dto->search}%")
              ->orWhere('email', 'like', "%{$dto->search}%");
        });
    }
}

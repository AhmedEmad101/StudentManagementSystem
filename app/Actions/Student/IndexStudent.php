<?php

namespace App\Actions\Student;

use App\DTOs\StudentFilterDTO;
use App\Filters\Student\SearchFilter;
use App\Filters\Student\StatusFilter;
use App\Filters\Student\StudentFilterExecuter;
use App\Models\User;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Cache;
class IndexStudent
{public function __construct(protected StudentRepository $student_repository) {}
     public function execute(StudentFilterDTO $student_dto, int $pagination = 5)
    {
        $cacheKey = $this->buildCacheKey($student_dto, $pagination);

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($student_dto, $pagination) {

            $query = $this->student_repository->index(['grades']);

            $filters = new StudentFilterExecuter([
                new SearchFilter,
                new StatusFilter,
            ]);

            $filters->apply($query, $student_dto);

            return $query
                ->orderByDesc('created_at')
                ->paginate($pagination);
        });
    }
      private function buildCacheKey(StudentFilterDTO $dto, int $pagination): string
    {
        return 'students:index:' . md5(json_encode([
            'search'   => $dto->search ?? null,
            'status'   => $dto->status ?? null,
            'page'     => request()->get('page', 1),
            'per_page' => $pagination,
        ]));
    }
}

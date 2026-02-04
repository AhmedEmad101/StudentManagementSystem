<?php

namespace App\Actions\Grade;

use App\Models\Grade;
use App\Repositories\GradeRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class DeleteGrade
{
    public function __construct(protected GradeRepository $gradeRepository) {}

    public function execute(Grade $grade): void
    {
        DB::transaction(function () use ($grade) {
            if (auth()->user()->role !== 'admin') {
                throw new AuthorizationException('Only admins can delete grades');
            }
            $this->gradeRepository->delete($grade->id);
        });
    }
}

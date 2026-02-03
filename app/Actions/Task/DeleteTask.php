<?php

namespace App\Actions\Task;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class DeleteTask
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {}

    public function execute(Task $task): void
    {

        DB::transaction(function () use ($task) {

            if (! auth()->user()->can('delete', $task)) {
                throw new AuthorizationException;
            }

            $this->taskRepository->delete($task->id);
        });
    }
}

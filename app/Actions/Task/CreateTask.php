<?php

namespace App\Actions\Task;

use App\DTOs\CreateTaskDTO;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;

class CreateTask
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {}

    public function execute(CreateTaskDTO $task_dto)
    {
        return DB::transaction(function () use ($task_dto) {

            $task = $this->taskRepository->store([
                'title' => $task_dto->title,
                'description' => $task_dto->description,
                'project_id' => $task_dto->project_id,
                'priority' => $task_dto->priority,
                'status' => $task_dto->status,
                'due_date' => $task_dto->due_date,
                'creator_id' => $task_dto->creator_id,
                'completed' => $task_dto->completed,
            ]);

            if (! empty($task_dto->tag_ids)) {
                $task->tags()->sync($task_dto->tag_ids);
            }

            if (! empty($task_dto->user_ids)) {
                $task->users()->sync($task_dto->user_ids);
            }

            return $task->load(['tags', 'users']);
        });
    }
}

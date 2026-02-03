<?php

namespace App\Actions\Task;

use App\DTOs\UpdateTaskDTO;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateTask
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {}

    public function execute(Task $task, UpdateTaskDTO $dto): Task
    {
        return DB::transaction(function () use ($task, $dto) {

            $this->ensureArchivedRules($task, $dto->task_data);
            $this->ensureDoneHasComments($task, $dto->task_data);
            $updated_task = $this->taskRepository->update($task->id, $dto->task_data);
            if (! empty($dto->tag_ids)) {
                $task->tags()->sync($dto->tag_ids);
            }

            return $updated_task->load('tags');
        });
    }

    private function ensureArchivedRules(Task $task, array $data): void
    {
        if ($task->status !== 'archived') {
            return;
        }

        if (! array_key_exists('status', $data)) {
            throw ValidationException::withMessages([
                'status' => 'archived task - you can not edit anything except status',
            ]);
        }

        if ($data['status'] !== 'in_progress') {
            throw ValidationException::withMessages([
                'status' => 'archived task status cannot be changed except to in progress',
            ]);
        }
    }

    private function ensureDoneHasComments(Task $task, array $data): void
    {
        if (
            isset($data['status']) &&
            $data['status'] === 'done' &&
            ! $task->comments()->exists()
        ) {
            throw ValidationException::withMessages([
                'status' => 'task cannot be marked as done if it has no comment',
            ]);
        }
    }
}

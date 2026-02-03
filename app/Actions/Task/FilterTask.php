<?php

namespace App\Actions\Task;

use App\DTOs\TaskFilterDTO;
use App\Models\Task;
use App\Strategies\CompletedFilter;
use App\Strategies\DueAfterFilter;
use App\Strategies\PriorityFilter;
use App\Strategies\ProjectFilter;
use App\Strategies\SearchFilter;
use App\Strategies\StatusFilter;
use App\Strategies\TaskFilter;

class FilterTask
{
    public function execute(TaskFilterDTO $task_dto, int $pagination = 5)
    {
        $query = Task::query()->visibleTo(auth()->user());

        $filters = new TaskFilter([
            new ProjectFilter,
            new PriorityFilter,
            new StatusFilter,
            new SearchFilter,
            new DueAfterFilter,
            new CompletedFilter,
        ]);

        $filters->apply($query, $task_dto);

        return $query
            ->orderByDesc('created_at')
            ->paginate($pagination);
    }
}

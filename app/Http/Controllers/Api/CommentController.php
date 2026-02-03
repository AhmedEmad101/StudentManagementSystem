<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Traits\ApiResponseTrait;

class CommentController extends Controller
{
    use ApiResponseTrait;

    public function index($taskId)
    {
        return Comment::where('task_id', $taskId)
            ->with('task')
            ->latest()
            ->get();
    }

    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $task = Task::findOrFail($validated['task_id']);
        $user = auth()->user();
        if (! ($user->id == $task->creator_id && ! $task->users->contains($user->id))) {
            $this->errorResponse(
                'Unauthorized. Only the task creator or assigned members can comment.', 403);
        }
        $comment = Comment::create($validated);

        return response()->json($comment, 201);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();
        $task = Task::findOrFail($validated['task_id']);
        $user = auth()->user();
        if (! ($user->id === $task->creator_id)) {
            return $this->errorResponse(
                'Unauthorized. Only the task creator or assigned members can comment.', 403);
        }

        $comment->update($validated);

        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->successResponse([],
            'Comment deleted successfully', 200
        );
    }
}

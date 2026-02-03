<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Traits\ApiResponseTrait;

class ProjectController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $projects = Project::with('tasks')->where('creator_id', auth()->id())->get();

        return $this->successResponse(ProjectResource::collection($projects), 'projects are retrieved successfully', 200);
    }

    public function show($id)
    {

        $project = Project::where('creator_id', auth()->id())->findOrFail($id);

        return $this->successResponse(new ProjectResource($project), 'project is retrieved successfully', 200);

    }

    public function store(StoreProjectRequest $request)
    {
        try {
            $project_data = $request->validated();
            $project_data['creator_id'] = auth()->id();
            $project = Project::create($project_data);

            return $this->successResponse(new ProjectResource($project), 'project is created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }

    }

    public function update(Project $project, UpdateProjectRequest $request)
    {
        try {
            $project_data = $request->validated();
            if ($project->creator_id != auth()->user()->id) {
                throw new \Exception('You are not allowed to update this project.');
            }
            $project->update($project_data);

            return $this->successResponse(new ProjectResource($project), 'project is updated successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

    }
}

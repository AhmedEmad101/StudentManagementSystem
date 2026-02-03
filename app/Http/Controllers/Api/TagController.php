<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Traits\ApiResponseTrait;

class TagController extends Controller
{
    use ApiResponseTrait;

    public function show($id)
    {
        try {
            $tag = Tag::with('tasks')->findOrFail($id);

            return $this->successResponse(new TagResource($tag), 'task responded successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 404);
        }
    }

    public function index()
    {
        $tags = Tag::paginate(5);
        if (count($tags) > 0) {
            return $this->successResponse(TagResource::collection($tags), 'tags are retrieved successfully', 200);
        }

        return $this->errorResponse('No tag is found', 404);
    }
}

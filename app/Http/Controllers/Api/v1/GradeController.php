<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Grade\CreateGrade;
use App\Actions\Grade\DeleteGrade;
use App\Actions\Grade\IndexGrade;
use App\Actions\Grade\ShowGrade;
use App\Actions\Grade\UpdateGrade;
use App\DTOs\CreateGradeDTO;
use App\DTOs\GradeFilterDTO;
use App\DTOs\UpdateGradeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterGradeRequest;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use App\Repositories\GradeRepository;
use App\Traits\ApiResponseTrait;

class GradeController extends Controller
{
    use ApiResponseTrait;

    public function index(IndexGrade $grade, FilterGradeRequest $request)
    {
        $grades = $grade->execute(GradeFilterDTO::fromRequest($request), 10);

        return $this->successResponse(GradeResource::collection($grades));
    }

    public function show(Grade $grade, ShowGrade $show_grade)
    {
        $user_grade = $show_grade->execute($grade);

        return $this->successResponse(new GradeResource($user_grade));
    }

    public function store(StoreGradeRequest $request, CreateGrade $createGrade)
    {
        $grade = $createGrade->execute(CreateGradeDTO::fromRequest($request));

        return $this->successResponse(new GradeResource($grade), 'Grade created successfully', 201);
    }

    public function update(UpdateGradeRequest $request, Grade $grade, UpdateGrade $updateGrade)
    {
        $updatedGrade = $updateGrade->execute($grade, UpdateGradeDTO::fromRequest($request));

        return $this->successResponse(new GradeResource($updatedGrade), 'Grade updated successfully', 200);
    }

    public function destroy(Grade $grade, DeleteGrade $deleteGrade)
    {
        $deleteGrade->execute($grade);

        return $this->successResponse([], 'Grade deleted successfully', 204);
    }
}

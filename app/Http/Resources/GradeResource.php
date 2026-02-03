<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student' => $this->student ? [
                'id' => $this->student->id,
                'name' => $this->student->name,
                'email' => $this->student->email,
            ] : null,
            'course' => $this->course ? [
                'id' => $this->course->id,
                'title' => $this->course->title,
            ] : null,
            'grade_value' => $this->grade_value,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

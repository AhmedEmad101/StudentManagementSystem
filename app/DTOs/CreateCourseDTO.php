<?php

namespace App\DTOs;

use App\Http\Requests\StoreCourseRequest;

class CreateCourseDTO
{
    public string $title;

    public string $code;

    public ?string $description;

    public int $hours;

    public function __construct(string $title, string $code, ?string $description, int $hours)
    {
        $this->title = $title;
        $this->code = $code;
        $this->description = $description;
        $this->hours = $hours;
    }

    public static function fromRequest(StoreCourseRequest $request): self
    {
        return new self(
            $request->title,
            $request->code,
            $request->description,
            $request->hours
        );
    }
}

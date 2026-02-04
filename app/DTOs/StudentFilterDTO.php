<?php

namespace App\DTOs;

use App\Http\Requests\FilterStudentRequest;

class StudentFilterDTO
{
    public function __construct(
        public readonly ?string $search,
        public readonly ?string $status,
    ) {}

    public static function fromRequest(FilterStudentRequest $request): self
    {
        $data = $request->validated();

        return new self(
            search: $data['search'] ?? null,
            status: $data['status'] ?? null,
        );
    }
}

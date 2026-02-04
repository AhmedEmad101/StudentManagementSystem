<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class AttendanceFilterDTO
{
    public function __construct(
        public readonly ?date $search,
        public readonly ?date $status,
    ) {}

    public static function fromRequest(Request $request): self
    {

        return new self(
            search: $data['search'] ?? null,
            status: $data['status'] ?? null,
        );
    }
}

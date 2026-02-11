<?php

namespace App\DTOs;

use App\Http\Requests\FilterAttendanceRequest;
use Carbon\Carbon;
class AttendanceFilterDTO
{
    public function __construct(
        public readonly ?Carbon $date,
        public readonly ?int $user_id,
    ) {}
    public static function fromRequest(FilterAttendanceRequest $request): self
    {
        $data = $request->validated();

        return new self(
            $data['date'] ?? null,
           $data['user_id'] ?? null,
        );
    }
}

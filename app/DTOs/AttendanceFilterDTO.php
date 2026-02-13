<?php

namespace App\DTOs;

use App\Http\Requests\FilterAttendanceRequest;
use Carbon\Carbon;
class AttendanceFilterDTO
{
    public function __construct(
        public readonly ?Carbon $date_from,
        public readonly ?Carbon $date_to,
    ) {}
    public static function fromRequest(FilterAttendanceRequest $request): self
    {
        $data = $request->validated();

        return new self(
            isset($data['date_from']) ? Carbon::createFromFormat('d/m/Y', $data['date_from']):null,
            isset($data['date_to']) ? Carbon::createFromFormat('d/m/Y', $data['date_to']):null,
        );
    }
}

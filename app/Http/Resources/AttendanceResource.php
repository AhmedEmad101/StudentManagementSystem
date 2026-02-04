<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'user_id' => $this->user_id,
            'date' => $this->date,
            'check_in_at' => $this->check_in_at,
            'check_out_at' => $this->check_in_at,
            'status' => $this->status,
        ];
    }
}

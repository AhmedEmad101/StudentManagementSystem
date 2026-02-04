<?php

namespace App\DTOs;

use App\Http\Requests\StoreStudentRequest;

class CreateStudentDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $password,
        public string $status = 'active',
    ) {}

    public static function fromRequest(StoreStudentRequest $request): self
    {
        return new self(
            $request->name,
            $request->email,
            $request->phone,
            $request->password,
            $request->status ?? 'active'
        );
    }
}

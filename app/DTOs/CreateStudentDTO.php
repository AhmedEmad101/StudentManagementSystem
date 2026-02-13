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
        $student_data = $request->validated();
        return new self(
            $student_data['name'],
            $student_data['email'],
            $student_data['phone'],
            $student_data['password'],
            $student_data['status'] ?? 'active'
        );
    }
}

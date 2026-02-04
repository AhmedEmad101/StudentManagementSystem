<?php

namespace App\DTOs;

use App\Http\Requests\UpdateStudentRequest;

class UpdateStudentDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public ?string $password = null,
        public string $status = 'active',
    ) {}

    public static function fromRequest(UpdateStudentRequest $request): self
    {
        return new self(
            $request->name,
            $request->email,
            $request->phone,
            $request->password ? bcrypt($request->password) : null,
            $request->status ?? 'active'
        );
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ];
        if ($this->password) {
            $data['password'] = $this->password;
        }

        return $data;
    }
}

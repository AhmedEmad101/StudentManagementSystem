<?php

namespace App\DTOs;

final class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public array $roles
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request['name'],
            $request['email'],
            $request['password'],
            $request['roles']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'roles' => $this->roles,
        ];
    }
}

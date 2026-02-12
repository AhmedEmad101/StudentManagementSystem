<?php

namespace App\Interfaces;

use App\Models\User;

interface StudentInterface
{
    public function index(array $relationships = [], int $pagination = 5);

    public function show(int $id);

    public function store(array $array);

    public function update(User $user, array $array);

    public function delete(User $user);
}

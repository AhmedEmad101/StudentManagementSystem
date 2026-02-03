<?php

namespace App\Interfaces;

interface GradeInterface
{
    public function index(array $relationships = [], int $pagination = 5);

    public function show(int $id);

    public function store(array $array);

    public function update(int $id, array $array);

    public function delete(int $id);
}

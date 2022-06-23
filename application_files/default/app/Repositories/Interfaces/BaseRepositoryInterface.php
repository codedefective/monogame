<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): array;
    public function updateById(int $id, array $params): array;
    public function deleteById(int $id): array;

}

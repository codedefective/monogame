<?php

namespace App\Repositories\Interfaces;

interface AdminRepositoryInterface extends BaseRepositoryInterface
{
    public function getUserByUsername(string $username): array;
    public function getUserByEmail(string $email): array;
    public function createUser(array $params): array;
    public function updateUserByUserName(string $username, array $params): array;
    public function updateUserByEmail(string $email, array $params): array;
}

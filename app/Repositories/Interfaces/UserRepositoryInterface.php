<?php
namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers(): Collection;
    public function getUserById($id): ?User;
    public function createUser(array $data): User;
    public function updateUser($id, array $data): bool;
    public function deleteUser($id): bool;
}

<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepo
    ) {}

    public function getAllUsers()
    {
        return $this->userRepo->all();
    }

    public function createUser(array $data): User
    {
        // Additional logic (e.g., hashing passwords, etc.)
        $data['password'] = bcrypt($data['password']);
        return $this->userRepo->create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $this->userRepo->update($user, $data);
    }

    public function deleteUser(User $user): bool
    {
        return $this->userRepo->delete($user);
    }
}

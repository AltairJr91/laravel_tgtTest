<?php

namespace App\Services;

use App\Repositories\UserPermissionRepositoryInterface;
use App\Models\User;

class UserPermissionServices
{
    public function __construct(
        private UserPermissionRepositoryInterface $repo
    ) {}

    public function assignPermission(User $user, string $permission)
    {
        return $this->repo->assignPermission($user, $permission);
    }

    public function assignRole(User $user, string $role)
    {
        return $this->repo->assignRole($user, $role);
    }

    public function autoAssignAdmin(User $user)
    {
        return $this->repo->assignRole($user, 'admin');
    }
}

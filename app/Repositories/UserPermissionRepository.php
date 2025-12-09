<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserPermissionRepositoryInterface;

class UserPermissionRepository implements UserPermissionRepositoryInterface
{
    public function assignPermission($user, string $permission)
    {
        return $user->givePermissionTo($permission);
    }

    public function assignRole($user, string $role)
    {
        return $user->assignRole($role);
    }
}
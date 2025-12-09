<?php

namespace App\Repositories;

interface UserPermissionRepositoryInterface
{
    public function assignPermission($user, string $permission);
    public function assignRole($user, string $role);
}

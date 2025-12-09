<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissões
        Permission::create(['name' => 'create users','guard_name' => 'api' ]);
        Permission::create(['name' => 'edit users','guard_name' => 'api']);
        Permission::create(['name' => 'delete users','guard_name' => 'api']);
        Permission::create(['name' => 'view users','guard_name' => 'api']);

        // Roles
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $basic = Role::create(['name' => 'basic', 'guard_name' => 'api']);

       
        $admin->givePermissionTo([
            'create users',
            'edit users',
            'delete users',
            'view users',
        ]);

        $basic->givePermissionTo([
            'view users',
        ]);
    }
}
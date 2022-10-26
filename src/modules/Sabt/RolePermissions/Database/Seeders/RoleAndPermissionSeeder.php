<?php

namespace Sabt\RolePermissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\Sabt\RolePermissions\Models\Permission::$permissions as $permission)
        {
            Permission::findOrCreate($permission);
        }

        foreach (\Sabt\RolePermissions\Models\Role::$roles as $name => $permissions)
        {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }

    }
}

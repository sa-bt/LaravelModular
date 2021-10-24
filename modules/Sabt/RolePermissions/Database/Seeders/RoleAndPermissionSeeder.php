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
        Permission::findOrCreate('manage categories');
        Permission::findOrCreate('manage roles');
        Permission::findOrCreate('teach');

        Role::findOrCreate('teacher')->givePermissionTo(['teach']);

    }
}

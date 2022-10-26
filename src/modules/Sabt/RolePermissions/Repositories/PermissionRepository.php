<?php


namespace Sabt\RolePermissions\Repositories;


use Spatie\Permission\Models\Permission;

class PermissionRepository
{

    public function all()
    {
        return Permission::all();
    }
}

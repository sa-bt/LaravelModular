<?php


namespace Sabt\RolePermissions\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\RolePermissions\Models\Permission;

class RolePolicy
{
    use HandlesAuthorization;

    public function index($user)
    {
       return $user->hasPermissionTo(Permission::MANAGE_ROLES_PERMISSION);
    }

    public function create($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_ROLES_PERMISSION);
    }

    public function edit($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_ROLES_PERMISSION);
    }

    public function delete($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_ROLES_PERMISSION);
    }
}

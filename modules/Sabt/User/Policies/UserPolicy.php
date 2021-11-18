<?php


namespace Sabt\User\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\RolePermissions\Models\Permission;

class UserPolicy
{
    use HandlesAuthorization;

    public function view($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_USERS_PERMISSION);
    }

    public function edit($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_USERS_PERMISSION) || (auth()->id() === $user
                ->id);
    }

    public function addRole($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_USERS_PERMISSION);
    }

    public function removeRole($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_USERS_PERMISSION);
    }

    public function manualVerify($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_USERS_PERMISSION);
    }


    public function editProfile($user)
    {
        return auth()->check();
    }




}

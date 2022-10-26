<?php

namespace Sabt\Category\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_CATEGORIES_PERMISSION);
    }
}

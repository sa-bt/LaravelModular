<?php

namespace Sabt\Course\Policies;

use Sabt\Course\Models\Course;
use Sabt\Course\Models\Season;
use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;

class SeasonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Season $season)
    {
        //
    }


    public function create(User $user, Course $course)
    {

    }


    public function edit(User $user, Season $season)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION)
                && $user->id == $season->course->teacher->id
                && $user->id == $season->user_id);
    }

    public function delete(User $user, Season $season)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION)
                && $user->id == $season->course->teacher->id
                && $user->id == $season->user_id);
    }

    public function change_confirmation_status(User $user, Season $season)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ;
    }

    public function restore(User $user, Season $season)
    {
        //
    }

    public function forceDelete(User $user, Season $season)
    {
        //
    }
}

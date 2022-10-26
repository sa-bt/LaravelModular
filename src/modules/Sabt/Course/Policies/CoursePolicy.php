<?php

namespace Sabt\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\Course\Models\Course;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;

class CoursePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION));
    }
    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               $user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION);
    }

    public function createSeason(User $user,Course $course)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION) && $user->id == $course->teacher->id);
    }

    public function show(User $user, Course $course)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION) && $user->id == $course->teacher_id);
    }

    public function edit($user, $course)
    {
        if ($user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION)) return true;
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION) && $course->teacher_id == $user->id;
    }

    public function delete($user, $course)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION);
    }

    public function change_confirmation_status($user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION);
    }


    public function createLesson($user,$course)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
            ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION)
                && $user->id == $course->teacher->id);
    }


}

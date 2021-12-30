<?php

namespace Sabt\Course\Policies;

use Sabt\Course\Models\Course;
use Sabt\Course\Models\Lesson;
use Illuminate\Auth\Access\HandlesAuthorization;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;

class LessonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Lesson $lesson)
    {
        //
    }


    public function create(User $user, Course $course)
    {
        //
    }


    public function edit(User $user, Lesson $lesson)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION)
                && $user->id == $lesson->course->teacher->id);
    }

    public function delete(User $user, Lesson $lesson)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ||
               ($user->hasPermissionTo(Permission::MANAGE_COURSES_OWN_PERMISSION)
                && $user->id == $lesson->course->teacher->id);
    }

    public function change_status(User $user, Lesson $lesson)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ;
    }
    public function change_status_all(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_COURSES_PERMISSION) ;
    }

    public function restore(User $user, Lesson $lesson)
    {
        //
    }

    public function forceDelete(User $user, Lesson $lesson)
    {
        //
    }
}

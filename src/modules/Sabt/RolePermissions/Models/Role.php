<?php


namespace Sabt\RolePermissions\Models;


class Role extends \Spatie\Permission\Models\Role
{
    const TEACHER_ROLE = 'teacher';
    const SUPER_ADMIN_ROLE = 'super admin';
    const STUDENT_ROLE = 'student';
    static $roles = [
        self::TEACHER_ROLE => [
            Permission::TEACH_PERMISSION
        ],
        self::SUPER_ADMIN_ROLE => [
            Permission::SUPER_ADMIN_PERMISSION
        ],
        self::STUDENT_ROLE => [

        ],
    ];
}

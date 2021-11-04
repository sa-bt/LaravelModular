<?php


namespace Sabt\RolePermissions\Models;


class Role extends \Spatie\Permission\Models\Role
{
    const TEACHER_ROLE = 'teacher';
    static $roles = [
        self::TEACHER_ROLE => [
            Permission::TEACH_PERMISSION
        ]
    ];
}

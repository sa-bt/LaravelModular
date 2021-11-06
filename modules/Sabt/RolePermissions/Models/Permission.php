<?php


namespace Sabt\RolePermissions\Models;


class Permission extends \Spatie\Permission\Models\Permission
{

    const MANAGE_CATEGORIES_PERMISSION = 'manage categories';
    const MANAGE_COURSES_PERMISSION = 'manage courses';
    const MANAGE_ROLES_PERMISSION = 'manage roles';
    const TEACH_PERMISSION = 'teach';
    const SUPER_ADMIN_PERMISSION = 'super admin';

    static $permissions = [
        self::MANAGE_CATEGORIES_PERMISSION,
        self::MANAGE_ROLES_PERMISSION,
        self::MANAGE_COURSES_PERMISSION,
        self::TEACH_PERMISSION,
        self::SUPER_ADMIN_PERMISSION,
    ];
}

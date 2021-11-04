<?php


namespace Sabt\RolePermissions\Models;


class Permission extends \Spatie\Permission\Models\Permission
{

    const MANAGE_CATEGORIES_PERMISSION = 'manage categories';
    const MANAGE_ROLES_PERMISSION = 'manage roles';
    const TEACH_PERMISSION = 'teach';

    static $permissions = [
        self::MANAGE_CATEGORIES_PERMISSION,
        self::MANAGE_ROLES_PERMISSION,
        self::TEACH_PERMISSION
    ];
}

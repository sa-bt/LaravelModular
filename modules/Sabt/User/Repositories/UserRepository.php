<?php


namespace Sabt\User\Repositories;


use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;

class UserRepository
{
    public function findByEmail($email)
    {
        return User::query()->where('email', '=', $email)->first();
    }
    public function findById($id)
    {
        return User::query()->where('id', '=', $id)->first();
    }

    public function getTeachers()
    {
        return User::permission(Permission::TEACH_PERMISSION)->get();
    }

    public function paginate()
    {
        return  User::query()->paginate();
    }
}

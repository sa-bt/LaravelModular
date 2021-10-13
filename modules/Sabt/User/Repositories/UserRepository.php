<?php


namespace Sabt\User\Repositories;


use Sabt\User\Models\User;

class UserRepository
{
    public function findByEmail($email)
    {
        return User::query()->where('email', '=', $email)->first();
    }
}

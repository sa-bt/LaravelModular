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
        return User::query()->paginate();
    }

    public function update($user, $values)
    {
        $update = [
            "name"      => $values->name,
            "email"     => $values->email,
            "mobile"    => $values->mobile,
            "headline"  => $values->headline,
            "website"   => $values->website,
            "linkedin"  => $values->linkedin,
            "instagram" => $values->instagram,
            "twitter"   => $values->twitter,
            "facebook"  => $values->facebook,
            "youtube"   => $values->youtube,
            "status"    => $values->status,
            "bio"       => $values->bio,
            "username"  => $values->username,
            "image_id"  => $values->image_id,
        ];
        if (!is_null($values->password))
        {
            $update['password'] = bcrypt($values->password);
        }
        return $user->update($update);
    }
}

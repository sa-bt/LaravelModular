<?php


namespace Sabt\RolePermissions\Repositories;


use Sabt\Common\Responses\AjaxResponses;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function all()
    {
        return Role::all();
    }

    public function create($values)
    {
        return Role::create([
                                "name" => $values->name
                            ])
                   ->syncPermissions($values->permissions);
    }

    public function edit($role, $values)
    {
        return $role->syncPermissions($values->permissions)
                    ->update([
                                 "name" => $values->name
                             ]);
    }

    public function delete($role)
    {
        return $role->delete();
    }
}

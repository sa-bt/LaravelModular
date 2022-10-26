<?php


namespace Sabt\User\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Sabt\RolePermissions\Models\Role;
use Sabt\User\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(5)->create()->each(function ($user)
        {
            $user->assignRole('teacher');
        });
        User::firstOrCreate(["email" => "testbakhshian@gmail.com"], [
            "name"              => "sabt",
            "email"             => "testbakhshian@gmail.com",
            "mobile"            => "09169630567",
            "password"          => Hash::make("q.Q111111"),
            'email_verified_at' => now(),
        ])->assignRole(Role::SUPER_ADMIN_ROLE);

    }
}

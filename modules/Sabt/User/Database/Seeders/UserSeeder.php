<?php


namespace Sabt\User\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Sabt\User\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(5)->create()->each(function ($user)
        {
            $user->assignRole('teacher');
        });
        User::factory()->create([
                                    "name"     => "sabt",
                                    "email"    => "testbakhshian@gmail.com",
                                    "mobile"   => "09169630567",
                                    "password" => Hash::make("q.Q111111"),
                                ]);

    }
}

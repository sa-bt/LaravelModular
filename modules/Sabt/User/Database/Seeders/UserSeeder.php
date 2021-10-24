<?php


namespace Sabt\User\Database\Seeders;


use Illuminate\Database\Seeder;
use Sabt\User\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(5)->create()->each(function ($user){
            $user->assignRole('teacher');
        });
}
}

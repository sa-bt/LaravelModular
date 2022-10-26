<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    public static $seeders = [
        RoleAndPermissionSeeder::class,

];

    public function run()
    {
        foreach (self::$seeders as $seeder)
        {
            $this->call($seeder);
        }
        // \App\Models\User::factory(10)->create();
    }
}

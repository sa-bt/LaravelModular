<?php


namespace Sabt\Category\Database\Seeders;


use Illuminate\Database\Seeder;
use Sabt\Category\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory(5)->create();

    }
}

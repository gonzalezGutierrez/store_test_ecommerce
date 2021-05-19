<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = new Category();
        $category->name = 'women';
        $category->description = 'All to women';
        $category->save();

        $category = new Category();
        $category->name = 'man';
        $category->description = 'All to man';
        $category->save();

    }
}

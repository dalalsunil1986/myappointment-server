<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Src\Category\Category::class,1)->create(['name_en'=>'salon']);
        factory(\App\Src\Category\Category::class,1)->create(['name_en'=>'spa']);
        factory(\App\Src\Category\Category::class,1)->create(['name_en'=>'clinic']);
        factory(\App\Src\Category\Category::class,1)->create(['name_en'=>'home service']);
    }
}

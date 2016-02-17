<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Src\User\User::class, 1)->create(['email'=>'admin@test.com','admin'=>1]);
        factory(App\Src\User\User::class, 5)->create();
    }
}

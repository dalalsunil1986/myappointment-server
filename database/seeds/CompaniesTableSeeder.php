<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = App\Src\Category\Category::lists('id')->toArray();
        $users = App\Src\User\User::lists('id')->toArray();

        factory(\App\Src\Company\Company::class, 20)->create()->each(function($company) use ($categories,$users) {
            $company->categories()->sync([$categories[array_rand($categories)]]);
            $company->users()->sync([$users[array_rand($users)]]);
            $company->favorites()->sync([$users[array_rand($users)]]);
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Src\Company\Holiday::class,10)->create()->each(function($holiday){
            $company = App\Src\Company\Company::orderByRaw("RAND()")->first();
            $company->holidays()->save($holiday);
        });
    }
}

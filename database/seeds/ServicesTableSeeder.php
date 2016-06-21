<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $companies =  App\Src\Company\Company::lists('id')->toArray();

        factory(App\Src\Service\Service::class, 200)->create()->each(function($service) use ($companies,$faker) {
            $service->companies()->sync([$companies[array_rand($companies)]=>['price'=>$faker->randomFloat(3,2)]]);
        });
    }
}

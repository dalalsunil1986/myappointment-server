<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Src\User\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
        'admin' => 0,
        'active' => 1
    ];
});

$factory->define(\App\Src\Category\Category::class, function (Faker\Generator $faker) {
    return [
        'name_en' => $faker->randomElement(['spa','salon','clinic']),
//        'description_en' => $faker->sentence(10),
        'image' => $faker->imageUrl($width = 500, $height = 960,array_rand(['city'=>'city','cats'=>'cats','nature'=>'nature']))
    ];
});

$factory->define(\App\Src\Company\Company::class, function (Faker\Generator $faker) {
    return [
        'name_en' => $faker->company,
        'address_en' => $faker->address,
//        'description_en' => $faker->sentence(10),
        'city_en' => $faker->city,
        'opens_at' => '8:00-am',
        'closes_at'=> '5:30-pm',
        'latitude' =>$faker->randomElement(['29.333298','29.330863','29.327253','29.329760','29.311406']),
        'longitude'=>$faker->randomElement(['47.909263','47.960333','47.993742','48.033611','48.063952']),
        'image' => $faker->imageUrl($width = 500, $height = 960,array_rand(['city'=>'city','cats'=>'cats','nature'=>'nature']))
    ];
});

$factory->define(\App\Src\Service\Service::class, function (Faker\Generator $faker) {
    return [
        'name_en' => $faker->word,
        'parent_id' => 0,
        'description_en' => $faker->sentence(10),
        'image' => $faker->imageUrl($width = 500, $height = 960,array_rand(['city'=>'city','cats'=>'cats','nature'=>'nature']))
    ];
});

$factory->define(\App\Src\Employee\Employee::class, function (Faker\Generator $faker) {
    return [
        'company_id' => 1,
        'name_en' => $faker->firstName,
        'image' => $faker->imageUrl($width = 500, $height = 960,array_rand(['city'=>'city','cats'=>'cats','nature'=>'nature'])),
        'holidays'=>$faker->randomElement(['sunday','monday','tuesday','wednesday','thursday','friday','saturday'])
    ];
});

$factory->define(\App\Src\Timing\Timing::class, function (Faker\Generator $faker) {
    return [
        'time_en' => '10:30-11:00'
    ];
});

$factory->define(\App\Src\Appointment\Appointment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'company_id' => 1,
        'service_id' => 1,
        'timing_id' => 1,
        'employee_id' => 1,
        'status' => 'confirmed',
        'date' => $faker->dateTimeBetween('now','+1 year')
    ];
});

$factory->define(\App\Src\Company\Holiday::class, function (Faker\Generator $faker) {
    return [
        'company_id' => 1,
        'date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 month')
    ];
});
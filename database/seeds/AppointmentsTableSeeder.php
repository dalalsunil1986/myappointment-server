<?php

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker =  Faker\Factory::create();
        factory(App\Src\Appointment\Appointment::class,25)->make()->each(function($appointment) use ($faker) {
            $company = App\Src\Company\Company::orderByRaw("RAND()")->first();

            $service = $company->services->random();
//            $service = App\Src\Service\Service::orderByRaw("RAND()")->first();
            $employee = App\Src\Employee\Employee::orderByRaw("RAND()")->first();
            $timing = App\Src\Timing\Timing::orderByRaw("RAND()")->first();
//            $user = App\Src\User\User::orderByRaw("RAND()")->first();
            $user = App\Src\User\User::find(1);
            $date = $faker->dateTimeBetween('-1 month','+1 year');
            $appointment->company_id = $company->id;
            $appointment->service_id = $service->id;
            $appointment->employee_id = $employee->id;
            $appointment->timing_id = $timing->id;
            $appointment->user_id = $user->id;
            $appointment->date = $date;
            $appointment->save();
        });
    }
}

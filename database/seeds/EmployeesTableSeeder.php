<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Src\Employee\Employee::class,200)->create()->each(function($employee){
            $company = App\Src\Company\Company::orderByRaw("RAND()")->first();
            $company->employees()->save($employee);
        });
    }
}

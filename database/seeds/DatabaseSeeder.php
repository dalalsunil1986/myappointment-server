<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'users',
        'password_resets',
        'categories',
        'appointments',
        'companies',
        'services',
        'company_services',
        'company_categories',
        'holidays',
        'employees',
        'company_users',
        'timings'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->truncateDatabaseTables();
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(TimingsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(HolidaysTableSeeder::class);
        $this->call(AppointmentsTableSeeder::class);
        Model::reguard();

    }

    private function truncateDatabaseTables()
    {
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
    }

}

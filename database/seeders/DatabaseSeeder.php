<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BiodataSeeder::class,
            JobPositionSeeder::class,
            EmployeeBankSeeder::class,
            JobApplicationSeeder::class,
            PayrollPeriodSeeder::class,
            PaySlipSeeder::class,
            EmployeePayrollSeeder::class,
            LeaveRequestSeeder::class,
        ]);
    }
}

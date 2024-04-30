<?php

namespace Database\Seeders;

use App\Models\EmployeePayroll;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeePayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $employeePayroll = EmployeePayroll::create([
                'user_id' => $user->id
            ]);

            $user->fill([
                'employee_payroll_id' => $employeePayroll->id
            ]);
            $user->saveOrFail();

            if ($user->id == 1) {
                $employeePayroll->fill([
                    'salary' => '7' . random_int(1, 9) . '00000',
                    'employee_bank_id' => 1
                ]);

                $employeePayroll->saveOrFail();
            }
        }
    }
}

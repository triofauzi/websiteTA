<?php

namespace Database\Seeders;

use App\Models\PaySlip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaySlipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaySlip::insert([
            // [
            //     'user_id' => 1,
            //     'payroll_period_id' => 1,
            //     'pay_slip_path' => ''
            // ],
            // [
            //     'user_id' => 1,
            //     'payroll_period_id' => 2,
            //     'pay_slip_path' => ''
            // ],
            // [
            //     'user_id' => 1,
            //     'payroll_period_id' => 3,
            //     'pay_slip_path' => ''
            // ],
            // [
            //     'user_id' => 1,
            //     'payroll_period_id' => 4,
            //     'pay_slip_path' => ''
            // ],
            // [
            //     'user_id' => 1,
            //     'payroll_period_id' => 5,
            //     'pay_slip_path' => ''
            // ],
            // [
            //     'user_id' => 1,
            //     'payroll_period_id' => 6,
            //     'pay_slip_path' => ''
            // ]
        ]);
    }
}

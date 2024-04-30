<?php

namespace Database\Seeders;

use App\Models\PayrollPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayrollPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayrollPeriod::insert([
            [
                'period_code' => 'JAN2024',
                'pay_date' => '2024/01/25',
                'description' => '-'
            ],
            [
                'period_code' => 'MAR2024',
                'pay_date' => '2024/03/25',
                'description' => '-'
            ],
            [
                'period_code' => 'FEB2024',
                'pay_date' => '2024/02/25',
                'description' => '-'
            ],
            [
                'period_code' => 'APR2024',
                'pay_date' => '2024/04/25',
                'description' => '-'
            ],
            [
                'period_code' => 'MEI2024',
                'pay_date' => '2024/05/25',
                'description' => '-'
            ],
            [
                'period_code' => 'MEI2024',
                'pay_date' => '2024/06/25',
                'description' => '-'
            ],
        ]);
    }
}

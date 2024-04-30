<?php

namespace Database\Seeders;

use App\Models\EmployeeBank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeBank::insert([
            [
                'account_number' => "1099017809",
                'account_name' => 'Tatang Santoso',
                'currency' => 'IDR',
                'bank_name' => 'BCA',
                'bank_branch' => 'Jakarta Selatan',
                'user_id' => 1
            ],
            [
                'account_number' => "1119482889",
                'account_name' => 'Tatang Santoso',
                'currency' => 'IDR',
                'bank_name' => 'BRI',
                'bank_branch' => 'Jakarta Selatan',
                'user_id' => 1
            ],
            [
                'account_number' => "1233444409",
                'account_name' => 'Tatang Santoso',
                'currency' => 'IDR',
                'bank_name' => 'Mandiri',
                'bank_branch' => 'Jakarta Selatan',
                'user_id' => 1
            ],
            [
                'account_number' => "8593488477",
                'account_name' => 'Tatang Santoso',
                'currency' => 'IDR',
                'bank_name' => 'BNI',
                'bank_branch' => 'Jakarta Barat',
                'user_id' => 1
            ],
            [
                'account_number' => "34895777758",
                'account_name' => 'Tatang Santoso',
                'currency' => 'IDR',
                'bank_name' => 'Permata',
                'bank_branch' => 'Jakarta Timur',
                'user_id' => 1
            ]
        ]);
    }
}

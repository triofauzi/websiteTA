<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveRequest::insert([
            [
                'user_id' => 3,
                'leave_date_from' => '2024-04-12',
                'leave_date_to' => '2024-04-16',
                'description' => 'lorem ipsum',
                'reason' => 'lorem ipsum'
            ],
        ]);
    }
}

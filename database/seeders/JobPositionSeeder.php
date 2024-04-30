<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobPosition::insert([
            [
                'id' => 1,
                'name' => 'Supervisor',
                'salary_range' => '3500000 ~ 7500000',
                'parent_id' => NULl,
                'department' => 'Marketing',
                'job_type' => 'Permanent',
                'job_place' => 'Jakarta Selatan',
                'expected_experience' => '5 - 8 Years',
                'is_need_candidate' => 'N'
            ],
            [
                'id' => 2,
                'name' => 'Manager',
                'salary_range' => '3500000 ~ 7500000',
                'parent_id' => 1,
                'department' => 'Marketing',
                'job_type' => 'Permanent',
                'job_place' => 'Jakarta Selatan',
                'expected_experience' => '3 - 5 Years',
                'is_need_candidate' => 'N'
            ],
            [
                'id' => 3,
                'name' => 'Staff',
                'salary_range' => '3500000 ~ 7500000',
                'parent_id' => 2,
                'department' => 'Marketing',
                'job_type' => 'Permanent',
                'job_place' => 'Yogyakarta',
                'expected_experience' => '1 - 3 Years',
                'is_need_candidate' => 'N'
            ],
        ]);

        // JobPosition::factory()->count(15)->create();
        
        $users = User::all();

        foreach ($users as $user) {
            if ($user->id != 3) {
                $user->job_position_id = 1; // set as HR
                $user->saveOrFail();
            } else {
                $user->job_position_id = 3;
                $user->saveOrFail();
            }
        }
    }
}

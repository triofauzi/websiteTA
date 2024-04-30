<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('abcd1234'),
                'created_at' => Carbon::parse('01/01/2023', 'Asia/Jakarta'),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('abcd1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'employee',
                'email' => 'employee@gmail.com',
                'password' => Hash::make('abcd1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

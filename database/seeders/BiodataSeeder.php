<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $users = User::all();
        
        foreach ($users as $user) {
            $biodata = Biodata::create([
                'user_id' => $user->id
            ]);

            $user->fill([
                'biodata_id' => $biodata->id
            ]);
            $user->saveOrFail();

            $biodata->fill([
                'first_name' => $faker->firstName(),
                'middle_name' => $faker->lastName(),
                'last_name' => $faker->lastName()
            ]);

            $biodata->saveOrFail();
        }
    }
}

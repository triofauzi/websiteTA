<?php

namespace Database\Factories;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'residence_address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->date(),
            'place_of_birth' => $this->faker->city,
            'curriculum_vitae' => 'storage/files/application/curriculum-vitae/dummy-pdf.pdf', // assuming CVs are stored as files
            'job_position_id' => \App\Models\JobPosition::all()->random()->id, // Assuming JobPosition model exists
            'application_status' => 'submitted',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

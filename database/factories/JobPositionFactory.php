<?php

namespace Database\Factories;

use App\Models\JobPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosition>
 */
class JobPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'parent_id' => null, // Assuming there are no parent job positions by default
            'department' => $this->faker->word,
            'salary_range' => '5' . $this->faker->randomNumber(1) . '00000' . ' ~ ' . '6' . $this->faker->randomNumber(1) . '00000',
            'description' => $this->faker->paragraph,
            'job_type' => $this->faker->randomElement(['Contract', 'Permanent']),
            'job_place' => $this->faker->company,
            'expected_experience' => $this->faker->randomElement(['0 - 1 Years', '1 - 2 Years', '3 - 5 Years', '5 - 7 Years']),
            'is_need_candidate' => $this->faker->randomElement(['Y', 'N']),
        ];
    }
}

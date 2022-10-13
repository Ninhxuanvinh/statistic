<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $inputArray = [
            'Alice',
            'Bob',
            'Charlie'
        ];
        return [
            'sites_name' => Arr::random($inputArray),
            'date' => $this->faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
            'jobs_all' => random_int(1,100),
            'jobs_public' => random_int(1,100),
            'jobs_duplicated' => random_int(1,100),
        ];
    }
}

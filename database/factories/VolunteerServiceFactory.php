<?php

namespace Database\Factories;

use App\Models\VolunteerService;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VolunteerService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_name' => $this->faker->word
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\VolunteerRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VolunteerRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'city_id' => $this->faker->randomDigitNotNull,
        'mobile_no' => $this->faker->word,
        'facebook_link' => $this->faker->word,
        'volunteer_service_id' => $this->faker->randomDigitNotNull,
        'notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}

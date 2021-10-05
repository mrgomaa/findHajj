<?php

namespace Database\Factories;

use App\Models\DeadOmraRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeadOmraRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeadOmraRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mobile_no' => $this->faker->word,
        'request_sender_name' => $this->faker->word,
        'dead_name' => $this->faker->word,
        'dead_age' => $this->faker->randomDigitNotNull,
        'notes' => $this->faker->text
        ];
    }
}

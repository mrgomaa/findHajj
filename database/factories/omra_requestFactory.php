<?php

namespace Database\Factories;

use App\Models\omra_request;
use Illuminate\Database\Eloquent\Factories\Factory;

class omra_requestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = omra_request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'omra_date' => $this->faker->word
        ];
    }
}

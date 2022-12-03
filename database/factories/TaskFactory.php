<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake('en_US')->words(3, true),
            'details' => $this->faker->text(),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}


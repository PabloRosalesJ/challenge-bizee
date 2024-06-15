<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owner = User::inRandomOrder()->first()->id;
        $type = fake()->randomElement([1, 2]);

        return [
            'user_id'               => $owner,
            'state_id'              => State::inRandomOrder()->first()->id,
            'registered_agent_id'   => $type == 2 ? Agent::inRandomOrder()->first()->id : null,
            'name'                  => fake()->company(),
            'registered_agent_type' => $type,
        ];
    }
}

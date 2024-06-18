<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{

    protected $model = Agent::class;

    public function definition(): array
    {
        return [
            'state_id' => \App\Models\State::where('active', true)->inRandomOrder()->first()->id,
            'name'     => fake()->name(),
            'email'    => fake()->safeEmail(),
            'capacity' => fake()->numberBetween(5,15),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsCompany>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'state_id'              => State::where('active', 1)->inRandomOrder()->first()->id,
            'registered_agent_id'   => function () {
                return \App\Models\Agent::factory()->create()->id;
            },
            'name'                  => $this->faker->unique()->company,
            'registered_agent_type' => $this->faker->randomElement(['1', '2'])
        ];
    }
}

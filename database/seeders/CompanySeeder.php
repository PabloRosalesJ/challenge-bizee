<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Company;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $userIds = User::pluck('id')->toArray();
        $availableStateIds = State::whereNotIn('code', ['IL'])->pluck('id')->toArray();

        for ($i = 0; $i < 47; $i++) {
            $stateId = $faker->randomElement($availableStateIds);
            $this->createCompany($faker, $userIds, $stateId);
        }
    }

    private function createCompany($faker, $userIds, $stateId)
    {
        $agent = Agent::where('state_id', $stateId)->inRandomOrder()->first();
        $registeredAgentId = $agent ? $agent->id : null;
        $registeredAgentType = $agent ? 1 : 2;

        for ($i=0; $i < fake()->numberBetween(1, 10); $i++) {

            Company::create([
                'user_id' => $faker->randomElement($userIds),
                'state_id' => $stateId,
                'registered_agent_id' => $registeredAgentId,
                'name' => $faker->unique()->company,
                'registered_agent_type' => $registeredAgentType,
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Agent::factory()->count(2)->create([
            'state_id' => State::where('code', 'CA')->first()->id,
        ]);
        \App\Models\Agent::factory()->count(2)->create([
            'state_id' => State::where('code', 'TX')->first()->id,
        ]);

        // \App\Models\Agent::factory()->count(47)->create();

        State::whereNotIn('code', ['TX','CA', 'IL'])
        ->pluck('id')->each(function($s) {
            for ($i=0; $i < fake()->numberBetween(1, 12); $i++) {
                \App\Models\Agent::factory()->create(['state_id' => $s]);
            }
        });
    }
}

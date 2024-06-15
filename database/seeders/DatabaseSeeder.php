<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\State;
use Database\Seeders\StateSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Users
        \App\Models\User::factory(4)->create();
        \App\Models\User::factory()->create([
            'name' => 'Pablo Rosalees',
            'email' => 'mail@mail.com',
        ]);

        // --- States
        $this->call(StateSeeder::class);

        // --- Agents
        \App\Models\Agent::factory()->count(2)->create([
            'state_id' => State::where('code', 'CA')->first()->id,
        ]);
        \App\Models\Agent::factory()->count(2)->create([
            'state_id' => State::where('code', 'TX')->first()->id,
        ]);

        \App\Models\Agent::factory()->count(47)->create();

        // --- Companies
        \App\Models\Company::factory()->count(5)->create();
    }
}

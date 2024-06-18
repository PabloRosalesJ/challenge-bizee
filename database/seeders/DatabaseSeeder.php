<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\StateSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
     public function run(): void
    {
        $this->call(UserSeeder::class);

        $this->call(StateSeeder::class);

        $this->call(AgentSeeder::class);

        $this->call(CompanySeeder::class);
    }

}

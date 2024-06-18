<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(4)->create();
        \App\Models\User::factory()->create([
            'name' => 'Pablo Rosales',
            'email' => 'mail@mail.com',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Alabama', 'code' => 'AL', 'active' => true],
            ['name' => 'Alaska', 'code' => 'AK', 'active' => true],
            ['name' => 'Arizona', 'code' => 'AZ', 'active' => true],
            ['name' => 'Arkansas', 'code' => 'AR', 'active' => true],
            ['name' => 'California', 'code' => 'CA', 'active' => true],
            ['name' => 'Colorado', 'code' => 'CO', 'active' => true],
            ['name' => 'Connecticut', 'code' => 'CT', 'active' => true],
            ['name' => 'Delaware', 'code' => 'DE', 'active' => true],
            ['name' => 'Florida', 'code' => 'FL', 'active' => true],
            ['name' => 'Georgia', 'code' => 'GA', 'active' => true],
            ['name' => 'Hawaii', 'code' => 'HI', 'active' => true],
            ['name' => 'Idaho', 'code' => 'ID', 'active' => true],
            ['name' => 'Illinois', 'code' => 'IL', 'active' => false],
            ['name' => 'Indiana', 'code' => 'IN', 'active' => true],
            ['name' => 'Iowa', 'code' => 'IA', 'active' => true],
            ['name' => 'Kansas', 'code' => 'KS', 'active' => true],
            ['name' => 'Kentucky', 'code' => 'KY', 'active' => true],
            ['name' => 'Louisiana', 'code' => 'LA', 'active' => true],
            ['name' => 'Maine', 'code' => 'ME', 'active' => true],
            ['name' => 'Maryland', 'code' => 'MD', 'active' => true],
            ['name' => 'Massachusetts', 'code' => 'MA', 'active' => true],
            ['name' => 'Michigan', 'code' => 'MI', 'active' => true],
            ['name' => 'Minnesota', 'code' => 'MN', 'active' => true],
            ['name' => 'Mississippi', 'code' => 'MS', 'active' => true],
            ['name' => 'Missouri', 'code' => 'MO', 'active' => true],
            ['name' => 'Montana', 'code' => 'MT', 'active' => true],
            ['name' => 'Nebraska', 'code' => 'NE', 'active' => true],
            ['name' => 'Nevada', 'code' => 'NV', 'active' => true],
            ['name' => 'New Hampshire', 'code' => 'NH', 'active' => true],
            ['name' => 'New Jersey', 'code' => 'NJ', 'active' => true],
            ['name' => 'New Mexico', 'code' => 'NM', 'active' => true],
            ['name' => 'New York', 'code' => 'NY', 'active' => true],
            ['name' => 'North Carolina', 'code' => 'NC', 'active' => true],
            ['name' => 'North Dakota', 'code' => 'ND', 'active' => true],
            ['name' => 'Ohio', 'code' => 'OH', 'active' => true],
            ['name' => 'Oklahoma', 'code' => 'OK', 'active' => true],
            ['name' => 'Oregon', 'code' => 'OR', 'active' => true],
            ['name' => 'Pennsylvania', 'code' => 'PA', 'active' => true],
            ['name' => 'Rhode Island', 'code' => 'RI', 'active' => true],
            ['name' => 'South Carolina', 'code' => 'SC', 'active' => true],
            ['name' => 'South Dakota', 'code' => 'SD', 'active' => true],
            ['name' => 'Tennessee', 'code' => 'TN', 'active' => true],
            ['name' => 'Texas', 'code' => 'TX', 'active' => true],
            ['name' => 'Utah', 'code' => 'UT', 'active' => true],
            ['name' => 'Vermont', 'code' => 'VT', 'active' => true],
            ['name' => 'Virginia', 'code' => 'VA', 'active' => true],
            ['name' => 'Washington', 'code' => 'WA', 'active' => true],
            ['name' => 'West Virginia', 'code' => 'WV', 'active' => true],
            ['name' => 'Wisconsin', 'code' => 'WI', 'active' => true],
            ['name' => 'Wyoming', 'code' => 'WY', 'active' => true],
        ];

        DB::table('states')->insert($states);
    }
}

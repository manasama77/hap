<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name'      => 'Team 1',
            'is_active' => 1,
        ]);

        Team::create([
            'name'      => 'Team 2',
            'is_active' => 1,
        ]);

        Team::create([
            'name'      => 'Team 3',
            'is_active' => 1,
        ]);
    }
}

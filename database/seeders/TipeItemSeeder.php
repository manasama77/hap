<?php

namespace Database\Seeders;

use App\Models\TipeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipeItem::create([
            'name' => 'ZTE',
        ]);

        TipeItem::create([
            'name' => '250 M',
        ]);
    }
}

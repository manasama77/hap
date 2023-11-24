<?php

namespace Database\Seeders;

use App\Models\CategoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryItem::create([
            'name' => 'Kabel'
        ]);

        CategoryItem::create([
            'name' => 'Mikrotik'
        ]);
    }
}

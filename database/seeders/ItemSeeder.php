<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'category_item_id' => 1,
            'name'             => 'Kabel 250m',
            'unit'             => 'pcs',
            'qty'              => 0,
            'photo'            => null,
            'has_sn'           => 0,
            'created_by'       => 1,
            'updated_by'       => 1,
        ]);
    }
}

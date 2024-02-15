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
            'tipe_item_id'     => 1,
            'name'             => 'ZTE F660',
            'unit'             => 'pcs',
            'qty'              => 0,
            'photo'            => null,
            'has_sn'           => 1,
            'created_by'       => 1,
            'updated_by'       => 1,
        ]);

        Item::create([
            'category_item_id' => 2,
            'tipe_item_id'     => 2,
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

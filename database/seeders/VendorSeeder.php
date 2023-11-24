<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'name'         => 'PT. ABC',
            'phone_number' => '081234567890',
            'address'      => 'Jl. ABC No. 123',
            'pic'          => 'John Doe',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemSn;
use Carbon\Carbon;
use Faker\Factory;
use App\Models\StockIn;
use App\Models\StockInSeq;
use App\Models\StockInItem;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StockInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date = Carbon::now();
        $prefix_order_number = 'IN';
        $pre_order_number = $prefix_order_number . $current_date->format('y') . $current_date->format('m') . $current_date->format('d');

        StockIn::create([
            'order_number'     => $pre_order_number . '00001',
            'vendor_id'        => 1,
            'date_buy'         => $current_date->format('Y-m-d'),
            'date_in'          => $current_date->format('Y-m-d'),
            'po_number_vendor' => 'PO-' . $current_date->format('Y-m-d'),
            'attachment'       => null,
            'created_by'       => 1,
            'updated_by'       => 1,
        ]);

        StockInSeq::create([
            'date_in_seq' => $current_date->format('Y-m-d'),
            'seq'         => 1,
        ]);

        $faker = \Faker\Factory::create();
        $sn    = $faker->ean13;
        $mac   = $faker->macAddress;

        StockInItem::create([
            'stock_in_id' => 1,
            'item_id'     => 1,
            'qty'         => 1,
            'sn'          => $sn,
            'mac'         => $mac,
        ]);

        $sn_2  = $faker->ean13;
        $mac_2 = $faker->macAddress;
        StockInItem::create([
            'stock_in_id' => 1,
            'item_id'     => 1,
            'qty'         => 1,
            'sn'          => $sn_2,
            'mac'         => $mac_2,
        ]);

        StockInItem::create([
            'stock_in_id' => 1,
            'item_id'     => 2,
            'qty'         => 100,
            'sn'          => null,
            'mac'         => null,
        ]);

        Item::where('id', 1)->update([
            'qty' => 1,
        ]);

        Item::where('id', 2)->update([
            'qty' => 100,
        ]);

        ItemSn::create([
            'item_id'    => 1,
            'sn'         => $sn,
            'mac'        => $mac,
            'teknisi_id' => null,
        ]);

        ItemSn::create([
            'item_id'    => 1,
            'sn'         => $sn_2,
            'mac'        => $mac_2,
            'teknisi_id' => null,
        ]);
    }
}

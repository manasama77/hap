<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequestDetail;
use App\Models\ItemSn;
use App\Models\StockOutItem;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function get_list_item()
    {
        $item = Item::with([
            'category_item',
        ])->get();

        return response()->json([
            'data' => $item
        ]);
    }

    public function get_list_item_sn(Request $request)
    {
        $temp_id = $request->temp_id;

        $stock_out = StockOutItem::select('item_id')->where('temp_code', $temp_id)->get()->toArray();

        $item = ItemSn::where('item_id', $request->item_id)->whereNotIn('id', $stock_out)->get();

        return response()->json([
            'data' => $item
        ]);
    }

    public function get_list_item_sn_for_item_request(Request $request)
    {
        $temp_id = $request->temp_id;

        $temp_item = ItemRequestDetail::select('item_id')->where('temp_code', $temp_id)->get()->toArray();

        $item = ItemSn::where('item_id', $request->item_id)->whereNull('teknisi_id');

        if (count($temp_item) > 0) {
            $item->whereNotIn('id', $temp_item);
        }

        $sql = $item->toRawSql();

        $item = $item->get();

        return response()->json([
            'data' => $item,
            'sql' => $sql,
            'x' => count($temp_item),
        ]);
    }
}

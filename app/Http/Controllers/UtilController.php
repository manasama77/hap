<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequest;
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

    public function get_list_item_request_detail(Request $request)
    {
        $items = ItemRequest::where('id', $request->id)->first();

        $data = [];
        if ($items) {

            $id           = $items->id;
            $code         = $items->code;
            $date_request = $items->date_request;
            $note         = $items->note;

            $item_lists = ItemRequestDetail::where('item_request_id', $request->id)->get();

            $data = [
                'id'         => $id,
                'code'         => $code,
                'date_request' => $date_request,
                'note'         => $note,
                'lists'         => [],
            ];

            foreach ($item_lists as $i) {
                $item_request_detail_id = $i->id;
                $code                   = $i->code;
                $item_id                = $i->item_id;
                $item_sn_id             = $i->item_sn_id;
                $qty                    = $i->qty;

                $item_request_detail_id = $item_request_detail_id;
                $item_id                = $item_id;
                $item_sn_id             = $item_sn_id;
                $item_name              = "";
                $qty                    = $qty;
                $sn                     = null;
                $mac                    = null;


                if ($item_sn_id != null) {
                    $item_sn_mac = ItemSn::with('item')->where('id', $item_sn_id)->first();
                    $item_name   = $item_sn_mac->item->name;
                    $sn          = $item_sn_mac->sn;
                    $mac         = $item_sn_mac->mac;
                } else {
                    $items     = Item::where('id', $item_id)->first();
                    $item_name = $items->name;
                }

                $nested['item_request_detail_id'] = $item_request_detail_id;
                $nested['item_id']                = $item_id;
                $nested['item_sn_id']             = $item_sn_id;
                $nested['item_name']              = $item_name;
                $nested['qty']                    = $qty;
                $nested['sn']                     = $sn;
                $nested['mac']                    = $mac;

                array_push($data['lists'], $nested);
            }
        } else {
            return response()->json([
                'mesasge' => 'Item Not Found'
            ], 404);
        }

        return response()->json($data, 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Vendor;
use App\Models\StockIn;
use App\Models\StockInItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Stock IN";
        $lists = StockIn::with([
            'vendor',
            'stockInItems',
            'created_by_name',
            'updated_by_name',
        ])->orderBy('id', 'desc')->get();

        // dd($lists);

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.stock_in.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temp_id = 'IN' . rand(1, 99999999);
        $page_title = "Create Stock IN";
        $vendor = Vendor::get();

        // dd($lists);

        $data = [
            'page_title' => $page_title,
            'temp_id'      => $temp_id,
            'vendor'      => $vendor,
        ];
        return view('pages.stock_in.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'temp_id'          => 'required',
                'vendor_id'        => 'required',
                'date_buy'         => 'required',
                'date_in'          => 'required',
                'po_number_vendor' => 'required',
                'attachment'       => 'nullable',
            ]
        );

        $attachment = null;
        if ($request->hasFile('attachment')) {
            $attachment = Storage::disk('public')->put('stock_in', $request->file('attachment'));
        }

        $current_date = Carbon::now();
        $y            = $current_date->format('y');
        $m            = $current_date->format('m');
        $d            = $current_date->format('d');

        $last_sequence = StockIn::whereYear('created_at', $current_date->format('Y'))->whereMonth('created_at', $m)->orderBy('created_at', 'desc')->limit(1)->first();

        $last_sequence = $last_sequence ? $last_sequence->seq + 1 : 1;
        $order_number  = $this->generate_order_number($y, $m, $d, $last_sequence);

        $exec = StockIn::create(
            [
                'order_number'     => $order_number,
                'vendor_id'        => $request->vendor_id,
                'date_buy'         => $request->date_buy,
                'date_in'          => $request->date_in,
                'po_number_vendor' => $request->po_number_vendor,
                'attachment'       => $attachment,
                'sequence'         => $last_sequence,
                'created_by'       => auth()->user()->id,
                'updated_by'       => auth()->user()->id,
            ]
        );

        StockInItem::where('temp_code', $request->temp_id)->update(
            [
                'stock_in_id' => $exec->id,
                'temp_code'   => null,
            ]
        );

        $stock_in_items = StockInItem::where('stock_in_id', $exec->id)->get();
        foreach ($stock_in_items as $item) {
            $x = Item::find($item->item_id);
            $x->increment('qty', $item->qty);
            $x->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Stock IN has beed created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function store_temp(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        $data['updated_by'] = auth()->user()->id;

        StockInItem::create(
            [
                'item_id'    => $data['item_id'],
                'qty'        => $data['qty'],
                'temp_code'  => $data['temp_id'],
                'created_by' => $data['created_by'],
                'updated_by' => $data['updated_by'],
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Item has beed added'
        ]);
    }

    public function get_temp_item(Request $request)
    {
        $temp_id = $request->temp_id;
        $lists = StockInItem::with([
            'item',
        ])->where('temp_code', $temp_id)->get();

        return response()->json([
            'success' => true,
            'data' => $lists,
        ]);
    }

    public function delete_temp_item(Request $request)
    {
        $id = $request->id;
        StockInItem::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item has beed deleted'
        ]);
    }

    protected function generate_order_number($y, $m, $d, $last_sequence)
    {
        $order_number = 'IN' . $y . $m . $d . sprintf("%05d", $last_sequence);
        return $order_number;
    }
}

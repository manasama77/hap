<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ItemRequestDetail;
use App\Models\ItemRequestSeq;

class ItemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Item Request";
        $lists      = ItemRequest::with([
            'createdBy',
            'approvalBy'
        ])->orderBy('id', 'desc')->get();

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.item_request.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Create Item Request";
        $temp_id    = 'IN' . rand(1, 99999999);

        $data = [
            'page_title' => $page_title,
            'temp_id'    => $temp_id,
        ];
        return view('pages.item_request.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'temp_id'      => 'required',
                'date_request' => 'required',
                'note'         => 'required',
            ]
        );

        $current_date = Carbon::now();
        $y            = $current_date->format('y');
        $m            = $current_date->format('m');
        $d            = $current_date->format('d');

        $last_sequence = ItemRequestSeq::where('date_request', $current_date->format('Y-m-d'))->first();

        if (!$last_sequence) {
            $lq = 1;
            ItemRequestSeq::create(
                [
                    'date_request' => $current_date->format('Y-m-d'),
                    'seq'          => 1,
                ]
            );
        } else {
            $lq = $last_sequence->seq + 1;
            $last_sequence->increment('seq');
        }

        $last_sequence = $lq;
        $order_number  = $this->generate_order_number($y, $m, $d, $last_sequence);

        $exec = ItemRequest::create(
            [
                'code' => $order_number,
                'date_request' => $current_date,
                'approval_by' => null,
                'date_approval' => null,
                'status' => 'pending',
                'note' => $request->note,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]
        );

        ItemRequestDetail::where('temp_code', $request->temp_id)->update(
            [
                'item_request_id' => $exec->id,
                'temp_code'       => null,
            ]
        );

        $items_list = ItemRequestDetail::where('item_request_id', $exec->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Item Request has beed created'
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

        ItemRequestDetail::create(
            [
                'item_request_id' => null,
                'item_id'         => $request->item_id,
                'qty'             => $request->qty ?? 1,
                'qty_approved'    => 0,
                'item_sn_id'      => $request->item_sn_id ?? null,
                'temp_code'       => $request->temp_id,
                'created_by'      => auth()->user()->id,
                'updated_by'      => auth()->user()->id,
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
        $lists = ItemRequestDetail::with([
            'item',
            'itemSn',
        ])->where('temp_code', $temp_id);

        $sql = $lists->toRawSql();

        $lists = $lists->get();

        return response()->json([
            'success' => true,
            'data'    => $lists,
            'sql'    => $sql,
        ]);
    }

    protected function generate_order_number($y, $m, $d, $last_sequence)
    {
        $order_number = 'REQ' . $y . $m . $d . sprintf("%05d", $last_sequence);
        return $order_number;
    }
}

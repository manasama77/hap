<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ItemRequestDetail;
use App\Models\ItemRequestSeq;
use App\Models\ItemSn;

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
        $temp_id    = auth()->user()->id;
        ItemRequestDetail::where('temp_code', $temp_id)->delete();

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

        // generate last sequence
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
                'code'          => $order_number,
                'date_request'  => $request->date_request,
                'approval_by'   => null,
                'date_approval' => null,
                'status'        => 'pending',
                'note'          => $request->note,
                'created_by'    => auth()->user()->id,
                'updated_by'    => auth()->user()->id,
            ]
        );

        ItemRequestDetail::where('temp_code', $request->temp_id)->update(
            [
                'item_request_id' => $exec->id,
                'temp_code'       => null,
            ]
        );

        $x = ItemRequestDetail::where('item_request_id', $exec->id)->get();

        foreach ($x as $z) {
            $item_sn_id = $z->item_sn_id;

            if ($item_sn_id) {
                ItemSn::where('id', $item_sn_id)->update([
                    'status' => 'reserve'
                ]);
            }
        }

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
        $page_title = "Edit Item Request";
        $temp_id    = auth()->user()->id;
        ItemRequestDetail::where('temp_code', $temp_id)->delete();

        $items = ItemRequest::with([
            'itemRequestDetails',
            'itemRequestDetails.item',
            'itemRequestDetails.itemSn',
        ])->find($id);

        $data = [
            'page_title' => $page_title,
            'temp_id'    => $temp_id,
            'items'      => $items,
        ];
        return view('pages.item_request.form_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'temp_id'      => 'required',
                'date_request' => 'required',
                'note'         => 'required',
            ]
        );

        ItemRequest::where('id', $id)->update(
            [
                'date_request'  => $request->date_request,
                'approval_by'   => null,
                'date_approval' => null,
                'status'        => 'pending',
                'note'          => $request->note,
                'updated_by'    => auth()->user()->id,
            ]
        );

        ItemRequestDetail::where('temp_code', $request->temp_id)->update(
            [
                'item_request_id' => $id,
                'temp_code'       => null,
            ]
        );

        $x = ItemRequestDetail::where('item_request_id', $id)->get();

        foreach ($x as $z) {
            $item_sn_id = $z->item_sn_id;

            if ($item_sn_id) {
                ItemSn::where('id', $item_sn_id)->update([
                    'status' => 'reserve'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Item Request has beed updated'
        ]);
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

    public function get_temp_item_edit(Request $request)
    {
        $temp_id = $request->temp_id;
        $lists = ItemRequestDetail::with([
            'item',
            'itemSn',
        ])->where('temp_code', $temp_id);

        $sql = $lists->toRawSql();

        $lists = $lists->get();

        $item_request_id = $request->item_request_id;
        $list_prev = ItemRequestDetail::with([
            'item',
            'itemSn',
        ])->where('item_request_id', $item_request_id);

        $sql_prev = $list_prev->toRawSql();

        $list_prev = $list_prev->get();

        $merged_lists = $lists->merge($list_prev);


        return response()->json([
            'success'  => true,
            'data'     => $merged_lists,
            'sql'      => $sql,
            'sql_prev' => $sql_prev,
        ]);
    }

    protected function generate_order_number($y, $m, $d, $last_sequence)
    {
        $order_number = 'REQ' . $y . $m . $d . sprintf("%05d", $last_sequence);
        return $order_number;
    }
}

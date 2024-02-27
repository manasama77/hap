<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSn;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ItemRequestDetail;
use Illuminate\Support\Facades\DB;

class ItemApprovalController extends Controller
{
    public function index()
    {
        $page_title = "Request Approval";
        $lists      = ItemRequest::with([
            'createdBy',
            'approvalBy'
        ])->where('status', 'pending')->orderBy('id', 'desc')->get();

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.item_approval.main', $data);
    }

    public function store(Request $request)
    {
        $id                     = $request->id;
        $item_request_detail_id = $request->item_request_detail_id;
        $item_id                = $request->item_id;
        $item_sn_id             = $request->item_sn_id;
        $qty_approve            = $request->qty_approve;

        $item_request = ItemRequest::where('id', $id)->first();

        if (!$item_request) {
            return response()->json([
                'message' => 'Item Not Found'
            ], 404);
        }

        $created_by = $item_request->created_by;

        // cek ketersediaan
        for ($i = 0; $i < count($item_request_detail_id); $i++) {
            // referensi item yang dipinjam
            $x                = Item::where('id', $item_id[$i])->first();
            $category_item_id = $x->category_item_id;
            $tipe_item_id     = $x->tipe_item_id;
            $name             = $x->name;
            $unit             = $x->unit;
            $has_sn           = $x->has_sn;
            $qty_gudang       = $x->qty;

            if ($qty_approve[$i] > $qty_gudang) {
                return response()->json([
                    'message' => 'Item $name Stock tidak mencukupi',
                ], 404);
            }
        }

        DB::beginTransaction();

        for ($i = 0; $i < count($item_request_detail_id); $i++) {
            // referensi item yang dipinjam
            $x                = Item::where('id', $item_id[$i])->first();
            $category_item_id = $x->category_item_id;
            $tipe_item_id     = $x->tipe_item_id;
            $name             = $x->name;
            $unit             = $x->unit;
            $has_sn           = $x->has_sn;
            $qty_gudang       = $x->qty;

            // pembuatan stock untuk teknisi
            $check = Item::where('teknisi_id', $created_by)->where('parent_id', $item_id[$i])->count();

            if ($check == 0) {
                // jika check == 0 buat data stok baru
                $item_teknisi = Item::create([
                    'category_item_id' => $category_item_id,
                    'tipe_item_id'     => $tipe_item_id,
                    'name'             => $name,
                    'unit'             => $unit,
                    'qty'              => $qty_approve[$i],
                    'photo'            => null,
                    'has_sn'           => $has_sn,
                    'in_warehouse'     => 0,
                    'teknisi_id'       => $created_by,
                    'parent_id'        => $item_id[$i],
                ]);
            } else {
                $item_teknisi = Item::where('teknisi_id', $created_by)->where('parent_id', $item_id[$i])->increment('qty', $qty_approve[$i]);
            }

            $teknisi_item_id = $item_teknisi->id;
            $loan_item_id    = $item_teknisi->id;

            if (($item_sn_id[$i] == "null" ? null : $item_sn_id[$i]) != null) {
                $y   = ItemSn::where('id', $item_sn_id[$i])->first();
                $sn  = $y->sn;
                $mac = $y->mac;

                $x_loan = ItemSn::create([
                    'item_id'    => $teknisi_item_id,
                    'sn'         => $sn,
                    'mac'        => $mac,
                    'status'     => 'reserve',
                    'teknisi_id' => $created_by,
                    'parent_id'  => $item_sn_id[$i],
                ]);

                $loan_item_id = $x_loan->id;
            }

            // proses pengurangan stock gudang
            Item::where('id', $item_id[$i])->decrement('qty', $qty_approve[$i]);

            if (($item_sn_id[$i] == "null" ? null : $item_sn_id[$i]) != null) {
                ItemSn::where('id', $item_sn_id[$i])->update([
                    'status'     => 'out',
                    'teknisi_id' => $created_by,
                ]);
            }


            ItemRequestDetail::where('id', $item_request_detail_id[$i])->update([
                'qty_approved' => $qty_approve[$i],
                'loan_item_id' => $loan_item_id,
            ]);
        }

        ItemRequest::where('id', $id)->update([
            'approval_by'   => auth()->user()->id,
            'date_approval' => Carbon::now(),
            'status'        => 'approved',
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Proses Approve Berhasil',
        ], 500);
    }

    public function index_approved()
    {
        $page_title = "Request Approved";
        $lists      = ItemRequest::with([
            'createdBy',
            'approvalBy'
        ])->where('status', 'approved')->orderBy('id', 'desc')->get();

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.item_approval.main', $data);
    }
}

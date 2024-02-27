<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class StockMonitorController extends Controller
{
    public function index()
    {
        $page_title = "Stock Monitors";
        $lists = Item::orderBy('id', 'desc');

        if (auth()->user()->role == 'teknisi') {
            $lists->where('teknisi_id', auth()->user()->id);
        } else {
            $lists->where('in_warehouse', 1);
        }

        $lists = $lists->get();

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.stock_monitor.main', $data);
    }
}

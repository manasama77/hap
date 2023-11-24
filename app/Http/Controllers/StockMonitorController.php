<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class StockMonitorController extends Controller
{
    public function index()
    {
        $page_title = "Stock Monitors";
        $lists = Item::with([
            'category_item',
            'updated_by_name',
        ])->orderBy('id', 'desc')->get();

        // dd($lists);

        $data = [
            'page_title' => $page_title,
            'lists'      => $lists
        ];
        return view('pages.stock_monitor.main', $data);
    }
}
